<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    use HasFactory;
    protected $fillable = [
        'text',
        'user_id',
        'parent_id',
        'post_id',
        'faq_id',
        'created_at',
        'updated_at'
    ];

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function faq()
    {
        return $this->belongsTo(Faq::class, 'faq_id');
    }

    public function childComments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    
}
