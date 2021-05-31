<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Child extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $guard = 'child';

    protected $fillable = [
        'child_name',
        'child_father_name',
        'child_mother_name',
        'child_father_phone_number',
        'child_mother_phone_number',
        'child_father_email_id',
        'child_mother_email_id',
        'child_age',
        'child_gender',
        'child_address',
        'child_eating_habit',
        'child_special_skill',
        'child_hobby',

    ];

    protected $hidden = [
         'remember_token'
    ];
    protected $primaryKey = 'child_id';
}
