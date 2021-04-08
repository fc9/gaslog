<?php

namespace App\Repositories;

use App\Models\{Address, City, Disability, Group, GroupMember, GroupSchool, School, SchoolReligiousType, User};
use App\Enums\SchoolDegreeEnum;
use App\Enums\SchoolTypeEnum;
use App\Helpers\Data;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class GroupRepository extends BaseRepository
{
    protected $model = Group::class;

//    public function index($orderByName = false)
//    {
//        return $this->find(auth()->user()->id);
//    }

    public function create()
    {
        return [
            'group' => null,
            'disabilities' => Disability::all(['id', 'name', 'type']),
            'hasDisability' => false,
            'hasParticipation' => false,
            'schoolDegrees' => SchoolDegreeEnum::all(),
            'schoolReligiousTypes' => SchoolReligiousType::all(['id', 'name']),
            'schoolTypes' => SchoolTypeEnum::all(),
            'states' => City::states(),
        ];
    }

    public function store($payload = [])
    {
        \DB::beginTransaction();

        $group = (new $this->model)->fill($payload);
        $group->user_id = auth()->user()->id;
        $group->address_id = (new Address)->create($payload)->id;
        //$group->group_address_city = $payload['city_id'];
        //$group->group_address_state = $payload['state'];
        $group->save();

        foreach ($payload['members'] as $member) {
            $member['group_id'] = $group->id;
            (new GroupMember)->fill($member)->save();
        }

        foreach ($payload['schools'] as $_school) {
            $school = (new School)->fill($_school);
            $school->address_id = (new Address)->create($_school['address'])->id;
            //$school->group_id = $group->id;
            //$school->city_id = $school['address']['city_id'];
            $school->save();
            (new GroupSchool)->create(['group_id' => $group->id, 'school_id' => $school->id]);
        }

        \DB::commit();

        return $group;
    }

    public function edit($id)
    {
        $group = $this->model::with('address')
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        return [
                'group' => $group,
                'hasParticipation' => ($group->previous_participant + $group->recurring_participant) >= 1,
                'hasDisability' => $group->disabilities !== '{}',
            ] + $this->create();
    }

    public function update($id, $payload = [])
    {
        //Gate::authorize('update-group', $group);

        \DB::beginTransaction();

        $group = (new $this->model)->with('address')->findOrFail($id);
//        $payload = array_merge($payload, [
//            'user_id' => auth()->user()->id,
//            'group_address_city' => $payload['city_id'],
//            'group_address_state' => $payload['state'],
//        ]);

//        $validator = Validator::make($payload, []);
//        if ($validator->fails()) {
//            throw new \Exception($validator->errors());
//        }

        $group->fill($payload)->save();
        $group->address->fill($payload)->save();

        $this->syncMembers($group->id, Arr::get($payload, 'members'));
        $this->syncSchools($group->id, Arr::get($payload, 'schools'));

        \DB::commit();
    }

    public function destroy($id)
    {
        \DB::beginTransaction();

        $group = $this->newQuery()
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!empty($group)) {
            $group->members()->delete();
            $group->delete();
        }

        \DB::commit();
    }

    public function get(int $id, int $user_id = null)
    {
        $query = $this->newQuery()
            ->with('missions')
        ->where('id', $id);

        if ($user_id) {
            $query = $query->where('user_id', $user_id);
        }

        return $query->first();
    }

    public function find(int $user_id = null, $orderByName = false)
    {
        $query = $this->newQuery()
            ->with('missions');

        if ($user_id) {
            $query = $query->where('user_id', $user_id);
        }

        if ($orderByName) {
            $query = $query->orderBy('name');
        } else {
            $query = $query->orderBy('created_at', 'DESC');
        }

        return $query->get();//pluck('name', 'id');
    }

    protected function syncMembers($group_id, $members)
    {
        $ids = Data::getInt($members, '*.id', Data::NOT_NULLS);

        $query = GroupMember::where('group_id', $group_id);
        if (count($ids) > 0) {
            $query = $query->whereNotIn('id', $ids);
        }
        $query->delete();

        foreach ($members as $member) {
            GroupMember::updateOrCreate(
                ['group_id' => $group_id, 'id' => Arr::get($member, 'id', null)],
                $member + ['group_id' => $group_id]
            );
        }
    }

    protected function syncSchools($group_id, $schools)
    {
        $ids = Data::getInt($schools, '*.id', Data::NOT_NULLS);

        // Delete schools in the group outside in the ids
        $query = School::leftJoin('group_schools', 'schools.id', '=', 'group_schools.school_id')
            ->where('group_schools.group_id', $group_id)
            ->with('address');
        if (count($ids) > 0) {
            $query = $query->whereNotIn('schools.id', $ids);
        }

        if ($schools) {
            foreach ($query->get() as $school) {
                (new School)->findOrFail($school->school_id)->delete();
                $school->address->delete();
                (new GroupSchool)->where('group_id', $group_id)->where('school_id', $school->school_id)->delete();
            }
        }

        foreach ($schools as $school) {
            $address_id = Address::updateOrCreate(
                ['id' => Arr::get($school, 'address.id', null)],
                Arr::get($school, 'address', null)
            )->id;

            $school_id = School::updateOrCreate(
                ['id' => Arr::get($school, 'id', null)],
                ['address_id' => $address_id] + $school
            )->id;

            GroupSchool::updateOrCreate(
                ['group_id' => $group_id, 'school_id' => $school_id],
                ['group_id' => $group_id, 'school_id' => $school_id]
            );
        }
    }
}
