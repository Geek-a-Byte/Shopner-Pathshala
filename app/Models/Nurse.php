<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Nurse extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $guard = 'nurse';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'nurse_name',
        'nurse_email_id',
        'password',
        'nurse_gender',
        'nurse_address',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
    protected $primaryKey = 'nurse_id';
}