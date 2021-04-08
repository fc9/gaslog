<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disability extends Model
{
    use SoftDeletes;

    protected $table = 'disabilities';

    protected $fillable = [
        'name',
        'type'
    ];

    public function projectDisability() {
        return $this->hasOne('App\Models\ProjectDisability', 'disability_id');
    }
}
