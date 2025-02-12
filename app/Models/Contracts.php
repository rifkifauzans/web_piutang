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
        'employee_id',
        'region_id',
        'awal_janji',
        'akhir_janji',
        'nilai',
        'no_pks',
        'jangka_waktu',
        'luas',
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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'contract_id');  // Pastikan menggunakan 'contract_id'
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