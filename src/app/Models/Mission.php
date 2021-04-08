<?php

namespace App\Models;

use App\Enums\MissionEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends Model
{
    use SoftDeletes;

    protected $table = 'missions';

    const mission1 = ['no-grupo' => 'No Grupo'];
    const mission2 = ['probleminha' => 'No Probleminha'];
    const mission3 = ['na-pista' => 'Na Pista'];
    const mission4 = ['na-acao' => 'Na Ação'];
    const mission5 = ['todo-mundo' => 'Todo Mundo'];

    protected $fillable = [
        'user_id',
        'group_id',
        'code',
        'title',
        'description',
        'image_file',
        'text_field_1',
        'text_field_2',
        'text_field_3',
        'video_link',
        'allows_card',
        'allows_votes',
        'email_feedback',
        'is_public',
        'is_approved',
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**************************************/

    public function getCodeAttribute($value)
    {
        return MissionEnum::fromValue(intval($value));
    }

    public function getName()
    {

        if ($this->title == key(self::mission1)) {
            return self::mission1[key(self::mission1)];
        }

        if ($this->title == key(self::mission2)) {
            return self::mission2[key(self::mission2)];
        }

        if ($this->title == key(self::mission3)) {
            return self::mission3[key(self::mission3)];
        }

        if ($this->title == key(self::mission4)) {
            return self::mission4[key(self::mission4)];
        }

        if ($this->title == key(self::mission5)) {
            return self::mission5[key(self::mission5)];
        }

    }

}
