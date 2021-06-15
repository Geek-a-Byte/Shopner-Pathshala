<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id', 'parent_id',
        'comment'
    ];

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
