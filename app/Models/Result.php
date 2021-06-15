<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use Notifiable;
    use HasFactory;
    protected $guarded = [];


    public function childs()
    {
        return $this->hasMany(Child::class);
    }
    protected $fillable = [
        'child_result_id',
        'test_code',
        'score',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $primaryKey = 'result_id';
}
