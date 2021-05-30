<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $guard = 'teacher';

    protected $fillable = [
        'teacher_name',
        'teacher_email_id',
        'password',
        'teacher_gender',
        'teacher_address',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
    protected $primaryKey = 'teacher_id';
}
