<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name_city',
        'name_prov',
    ];

    public function condominiums()
    {
        return $this->hasMany(Condominium::class);
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
