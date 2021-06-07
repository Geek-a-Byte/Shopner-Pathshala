<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public function Doctor()
    {
        return $this->hasOne(Doctor::class);
        // return $this->hasOne(Phone::class, 'foreign_key');
    }
    public function Teacher()
    {
        return $this->hasOne(Teacher::class);
        // return $this->hasOne(Phone::class, 'foreign_key');
    }
    public function Nurse()
    {
        return $this->hasOne(Nurse::class);
        // return $this->hasOne(Phone::class, 'foreign_key');
    }
    public function Guardian()
    {
        return $this->hasOne(Guardian::class);
        // return $this->hasOne(Phone::class, 'foreign_key');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      
        'name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'normal_user';
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
