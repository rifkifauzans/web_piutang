<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Partners extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'partners';
    protected $fillable = [
        'profile_partner',
        'partner_name',
        'npwp',
        'pic_name',
        'address',
        'user_id' 
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contracts::class, 'partner_id', 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($partner) {
            
        });

        static::restoring(function ($partner) {
           
        });

        static::forceDeleted(function ($partner) {
            $partner->user()->forceDelete();

            if ($partner->profile_partner) {
                Storage::delete('public/partners/' . $partner->profile_partner);
            }
        });
    }
}
 