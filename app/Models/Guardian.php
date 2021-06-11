<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Guardian extends Authenticatable
{
    use Notifiable;

    protected $guard = 'guardian';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function childs()
    {
        return $this->hasMany(Child::class, 'acct_holder_id');
    }
    protected $fillable = [
        'user_id',
        'acct_holder_name', 'acct_holder_email', 'password', 'acct_holder_address', 'relation_with_child',
        'acct_holder_gender',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $primaryKey = 'acct_holder_id';

    public function posts()
    {
        return $this->hasMany(Post::class, 'acct_holder_id');
    }
}
