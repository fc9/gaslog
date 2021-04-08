<?php

namespace App\Models;

use App\Enums\GroupMemberTypeEnum;
use App\Enums\MissionEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $table = 'groups';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'address_id',
        'name',
        'group_address_state', #TODO: remove
        'group_address_city', #TODO: remove
        'group_type', #TODO: remove
        'group_organization', #TODO: remove
        'previous_participant',
        'recurring_participant',
        'disabilities',
        'others_disabilities',
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function members($type = null)
    {
        $members = $this->hasMany('App\Models\GroupMember');

        if ($type === null) {
            return $members;
        } elseif (empty($members->get())) {
            return null;
        }

        $groupMemberType = GroupMemberTypeEnum::coerce($type);
        $subMembers = [];
        foreach ($members->get() as $member) {
            if ($groupMemberType->is(GroupMemberTypeEnum::fromValue(intval($member->type)))) {
                $subMembers[] = $member;
            }
        }

        return $subMembers;
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'group_schools', 'group_id', 'school_id');
    }

    public function missions()
    {
        return $this->hasMany('App\Models\Mission');
    }

    /**************************************/

    public function getDisabilitiesAttribute($value)
    {
        return json_decode($value);
    }

    public function setDisabilitiesAttribute($value)
    {
        $this->attributes['disabilities'] = json_encode($value);
    }

//    public function getGroupTypeAttribute($value)
//    {
//        $enums = [
//            [
//                'label' => 'Escola Pública - Municipal',
//                'value' => 'MUNICIPAL_PUBLIC',
//            ],
//            [
//                'label' => 'Escola Pública - Estadual',
//                'value' => 'STATE_PULIC',
//            ],
//            [
//                'label' => 'Escola Pública - Federal',
//                'value' => 'FEDERAL_PUBLIC',
//            ],
//            [
//                'label' => 'Escola Comunitária',
//                'value' => 'COMMUNITY',
//            ],
//            [
//                'label' => 'Escola Particular',
//                'value' => 'PARTICULAR',
//            ],
//            [
//                'label' => 'ONG',
//                'value' => 'ONG',
//            ],
//            [
//                'label' => 'Outros',
//                'value' => 'OTHER',
//            ],
//        ];
//
//        if ($value) {
//
//            foreach ($enums as $enum) {
//
//                if ($enum['value'] == $value) {
//                    return $enum;
//                }
//            }
//        }
//    }

    /**************************************/

    public function hasDisability($id)
    {
        foreach ($this->disabilities as $disability) {
            if ($disability->id == $id) {
                return true;
            }
        }
        return false;
    }

    public function missionAccomplished(int $code)
    {
        foreach ($this->missions as $mission) {
            if ($mission->code->is($code)) {
                return true;
            }
        }

        return false;
    }
}
