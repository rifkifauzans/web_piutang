<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'invoices';

    protected $fillable = [
        'compensation_id',
        'tgl_terbit',
        'jatuh_tempo',
        'nilai_tagihan',
        'status',
        'jml_denda',
        'status_sp',
        'sp',
    ];

    public function compensation()
    {
        return $this->belongsTo(Compensation::class, 'compensation_id', 'id');
    }

}
