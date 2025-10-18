<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'condominium_id',
        'resident_id',
        'name',
        'unit_number',
        'floor',
        'square_metres',
        'rooms'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function resident()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }

    public function getDate($date)
    {
        if (!$date) {
            return '-';
        }

        return mb_convert_case(
            Carbon::parse($date)
                ->locale('it')
                ->translatedFormat('d F Y'),
            MB_CASE_TITLE,
            'UTF-8'
        );
    }
}
