<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Employees extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';
    protected $fillable = [
        'nik',
        'profile_picture',
        'employees_name',
        'position',
        'phone_number',
        'address'
    ];

    protected $dates = ['deleted_at'];
}
