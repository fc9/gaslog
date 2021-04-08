<?php

namespace App\Models;


use App\Models\TakenActionSubcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolReligiousType extends Model
{
    use SoftDeletes;

    protected $table = 'schools_religious_types';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:m',
        'updated_at' => 'datetime:d/m/Y H:m',
    ];

}
