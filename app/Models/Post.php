<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'body', 'slug'];

    public function Guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
