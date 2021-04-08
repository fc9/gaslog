<?php

namespace App\Models;

use App\Enums\SchoolDegreeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMember extends Model
{
    use SoftDeletes;

    protected $table = 'group_members';

    protected $primaryKey = 'id';

    protected $fillable = [
        'group_id',
        'type',
        'name',
        'age',
        'phone',
        'mobile_phone',
        'email',
        'school_degree',
        'user_address_state',
        'user_address_city',
        'user_school_name',
    ];

    public function group()
    {
        return $this->belongsTo('\App\Models\Group');
    }

    public function getSchoolDegreeAttribute($value)
    {
        return SchoolDegreeEnum::fromValue(intval($value));
    }
}
