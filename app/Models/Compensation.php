<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compensation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'compensation';

    protected $fillable = [
        'contract_id',
        'tahun',
        'jatuh_tempo',
        'nilai_kompensansi',
        'ppn',
        'nilai_plus_ppn',
        'pbb',
        'lainnya',
        'total',
    ];

    public function contract()
    {
        return $this->belongsTo(Contracts::class, 'contract_id', 'id');
    }
}
