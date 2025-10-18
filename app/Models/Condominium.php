<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Condominium extends Model
{
    protected $table = 'condominiums';

    protected $fillable = [
        'city_id',
        'administrator_id',
        'name',
        'address',
        'cap'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }


    public function administrator()
    {
        return $this->belongsTo(User::class);
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
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
