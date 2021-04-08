<?php

namespace App\Helpers;

class Data
{
    const NULLS = true;
    const NOT_NULLS = false;

    public static function getInt($arr = [], $key = '*', $null = self::NULLS)
    {
        $arr = data_get($arr, $key);

        if (!$null) {
            $arr = array_filter($arr, function ($v) {
                return !is_null($v);
            });
        }

        $arr = array_map(function ($item) {
            return intval($item);
        }, $arr);

        return $arr;
    }
}
