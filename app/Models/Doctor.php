<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $guard = 'doctor';

    protected $fillable = [
        'doctor_name',
        'doctor_email_id',
        'password',
        'doctor_gender',
        'doctor_address',
        'doctor_designation',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
    protected $primaryKey = 'doctor_id';
}
