<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compensharing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'compensharing';

    protected $fillable = [
        'contract_id',
        'tahun',
        'pendapatan_mitra',
        'kompensasi_sharing',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function setKompenasiSharingAttribute($value)
    {
        $this->attributes['kompensasi_sharing'] = $this->pendapatan_mitra * 0.30;
    }

}
