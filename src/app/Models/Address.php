<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = [
        'city_id',
        'zipcode',
        'address',
        'number',
        'additional',
        'phone',
    ];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function group()
    {
        return $this->hasOne('App\Group');
    }

    public function school()
    {
        return $this->hasOne('App\School');
    }
}
