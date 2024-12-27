<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Fields extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fields';

    protected $fillable = [
        'field_code',
        'field_name'
    ];

    protected $dates = ['deleted_at'];

    public static function generateFieldNumber()
    {
        return 'BD-' . mt_rand(1000000000, 9999999999);
    }

    protected static function booted()
    {
        static::creating(function ($field) {
            $field->field_code = self::generateFieldNumber();
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($field) {
            
        });

        static::restoring(function ($field) {
           
        });

        static::forceDeleted(function ($field) {
            $field->forceDelete();
        });
    }
}
