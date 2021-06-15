<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $fillable = [
        'acct_holder_id',
        'child_name', 'child_age', 'child_gender', 'father_name', 'father_phone_no', 'father_email', 'mother_name',
        'mother_phone_no', 'mother_email', 'communication_skill', 'special_skill', 'eating_habit', 'hobby', 'autism_type',
        'repeatative_behaviour',
    ];

    public function user()
    {
        return $this->belongsTo(Guardian::class, 'acct_holder_id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $primaryKey = 'child_id';
    protected $table = 'childs';
}
