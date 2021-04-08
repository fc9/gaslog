<?php

namespace App\Repositories;

use App\Models\{Address, City, Disability, Group, GroupMember, GroupSchool, Mission, School, SchoolReligiousType, User};
use App\Enums\MissionEnum;
use App\Enums\SchoolDegreeEnum;
use App\Enums\SchoolTypeEnum;
use App\Helpers\Data;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class MissionRepository extends BaseRepository
{
    protected $model = Mission::class;

    public function show(int $code, int $group_id = null)
    {
        $group = null;
        $mission = null;

        if ($group_id) {
            $group = (new GroupRepository)->get($group_id, auth()->user()->id);
            $mission = $this->get($code, $group_id, auth()->user()->id);
        }

        return compact('group', 'mission');
    }

    public function domingo(int $code, int $group_id = null)
    {
        $data = $this->show($code, $group_id);

        return $data;
    }

    public function segundaFeira(int $code, $group_id = null)
    {
        $data = $this->show($code, $group_id);

        return $data;
    }

    public function tercaFeira(int $code, $group_id = null)
    {
        $data = $this->show($code, $group_id);

        return $data;
    }

    public function quartaFeira(int $code, $group_id = null)
    {
        $data = $this->show($code, $group_id);

        return $data;
    }

    public function quintaFeira(int $code, $group_id = null)
    {
        $data = $this->show($code, $group_id);

        return $data;
    }

    public function sextaFeira(int $code, $group_id = null)
    {
        $data = $this->show($code, $group_id);

        return $data;
    }

    public function sabado(int $code, $group_id = null)
    {
        $data = $this->show($code, $group_id);

        return $data;
    }

    public function get(int $code = null, int $group_id = null, int $user_id = null)
    {
        $query = $this->newQuery();

        if ($group_id) {
            $query = $query->where('group_id', $group_id);
        }

        if ($user_id) {
            $query = $query->where('user_id', $user_id);
        }

        if ($code) {
            $query = $query->where('code', $code);
        }

        return $query->first();
    }
}
