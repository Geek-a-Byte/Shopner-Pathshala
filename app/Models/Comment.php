<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Guardian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function Guardian()
    {
        return $this->belongsTo(Guardian::class);
    }
    
    protected $fillable = [
        'user_id',
        'comment'
    ];

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
