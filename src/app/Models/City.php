<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model de cidades
 */
class City extends Model
{

    use SoftDeletes;

    protected $table = 'cities';

    protected $fillable = [
        'name',
        'state',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function scopeByState($query, $state)
    {
        return $query->where(['cities.state' => $state]);
    }

    public function scopeByName($query, $name)
    {
        return $query->where('cities.name', 'LIKE', "{$name}%");
    }

    public static function states()
    {
        return self::select('state')
            ->orderBy("state")
            ->distinct()
            ->get();
    }

}
