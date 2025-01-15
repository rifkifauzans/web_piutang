<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'payments';

    protected $fillable = [
        'invoice_id',
        'bukti_bayar',
        'tgl_bayar',
        'jml_bayar',
        'status',
        'ket',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id', 'id');
    }
}
