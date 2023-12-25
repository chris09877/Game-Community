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
        'created_at',
        'updated_at'
    ];
    
}
