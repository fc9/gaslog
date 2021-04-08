<?php

namespace App\Models;


use App\Enums\SchoolTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    public $table = 'schools';

    public $fillable = [
        'address_id',
        'name',
        'phone',
        'type',
        'school_religious_type_id',
        'other_school_religious_type',
    ];

    public function school_religious_type()
    {
        return $this->belongsTo('App\Models\SchoolReligiousType');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function getTypeAttribute( $value )
    {
        return SchoolTypeEnum::fromValue(intval($value));
    }

    public function getFullAddressAttribute() {
        return "{$this->address_address}, {$this->address_number}";
    }

    /**
     * filtra por estado.
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeState($query, $states)
    {
        return $query->whereExists(function ($query) use ($states) {
            $query->select(\DB::raw(1))->from('cities')->whereIn('state',$states)
                ->whereRaw('schools.city_id = cities.id');
        });
    }
}
