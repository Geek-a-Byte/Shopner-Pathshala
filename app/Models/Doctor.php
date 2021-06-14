<?php

namespace App\Models;

use App\Models\Guardian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $guard = 'doctor';
    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'doctor_guardian', 'acct_holder_id', 'doctor_id');
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    protected $fillable = [
        'user_id',
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
