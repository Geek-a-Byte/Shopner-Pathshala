<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Guardian extends Authenticatable
{
    use Notifiable;

    protected $guard = 'guardian';

    protected $fillable = [
        'acct_holder_name', 'acct_holder_email', 'password', 'acct_holder_address', 'relation_with_child',
        'acct_holder_gender',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $primaryKey = 'acct_holder_id';
}
