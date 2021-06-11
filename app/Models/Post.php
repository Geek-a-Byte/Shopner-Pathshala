<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Guardian;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'body', 'slug'];

    public function user()
    {
        return $this->belongsTo(Guardian::class, 'acct_holder_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
