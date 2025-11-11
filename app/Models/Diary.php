<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table = 'diaries';

    protected $fillable = [
        'user_id',
        'date',
        'title',
        'content',
        'category',
        'is_important',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id');
    }


    public function getDate($date)
    {
        if (!$date) {
            return '-';
        }

        return mb_convert_case(
            Carbon::parse($date)
                ->locale('it')
                ->translatedFormat('j M'),
            MB_CASE_TITLE,
            'UTF-8'
        );
    }
   
    public function getYear($date)
    {
        if (!$date) {
            return '-';
        }

        return mb_convert_case(
            Carbon::parse($date)
                ->locale('it')
                ->translatedFormat('Y'),
            MB_CASE_TITLE,
            'UTF-8'
        );
    }
}
