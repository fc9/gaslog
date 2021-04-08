<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model de cidades
 */
class GroupSchool extends Model
{
    use SoftDeletes;

    protected $table = 'group_schools';

    protected $fillable = [
        'group_id',
        'school_id',
    ];

    protected $dates = [
        'deleted_at'
    ];
}
