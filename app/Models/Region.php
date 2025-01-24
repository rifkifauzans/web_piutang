<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Region extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'region';
    protected $fillable = [
        'lokasi',
        'kab_kota'
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($region) {
            
        });

        static::restoring(function ($region) {
           
        });

        static::forceDeleted(function ($region) {
            $region->forceDelete();
        });
    }
}
