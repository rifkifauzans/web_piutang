<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoices';

    protected $fillable = [
        'compensation_id',
        'contract_id',
        'tgl_terbit',
        'status',
        'jml_denda',
        'status_sp',
        'total_tagihan',
        'jml_bayar',
        'sisa_tagihan',
    ];

    protected $dates = ['deleted_at'];

    // Menentukan relasi ke tabel lain
    public function compensation()
    {
        return $this->belongsTo(Compensation::class, 'compensation_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
