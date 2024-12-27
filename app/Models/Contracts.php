<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contracts extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contracts';

    protected $fillable = [
        'contract_code',
        'partner_id',
        'field_id',
        'badan_hukum',
        'pic_aa',
        'awal_janji',
        'akhir_janji',
        'nilai',
        'no_pks',
        'lokasi',
        'kab_kota',
        'jangka_waktu',
        'luas',
        'no_wa',
        'ket',
        'status',
    ];

    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id', 'user_id');
    }

    public function field()
    {
        return $this->belongsTo(Fields::class);
    }

    public static function generateContractNumber()
    {
        return 'CT-' . mt_rand(1000000000, 9999999999);
    }

    protected static function booted()
    {
        static::creating(function ($contract) {
            // Menggunakan metode generateOrderNumber untuk mendapatkan kode unik
            $contract->contract_code = self::generateContractNumber();
        });
    }

}
