<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'resident_id',
        'url_pdf',
        'name_file',
        'note',
        'price',
        'date',
        'is_pay'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'date' => 'date',
        'is_pay' => 'boolean'
    ];

    public function resident()
    {
        return  $this->belongsTo(User::class, 'resident_id');
    }

    public function document()
    {
        return  $this->hasOne(Document::class);
    }

    public function getDate($date)
    {
        if (!$date) {
            return '-';
        }

        return mb_convert_case(
            Carbon::parse($date)
                ->locale('it')
                ->translatedFormat('d M Y'),
            MB_CASE_TITLE,
            'UTF-8'
        );
    }
}
