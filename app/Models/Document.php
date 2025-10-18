<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'notice_board_id',
        'condominium_id',
        'name_file',
        'url_pdf',
        'mime_type',
        'uploaded_by'
    ];

    /**
     * Documento appartiene a una bacheca
     */
    public function noticeBoard()
    {
        return $this->belongsTo(NoticeBoard::class);
    }

    /**
     * Documento appartiene a un condominio
     */
    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    /**
     * Documento è stato caricato da un utente
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
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
