<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public $timestamps = false;
    protected $table = "post";
    protected $primaryKey = 'id';
    public $incrementing = true; // Indicates if the IDs are auto-incrementing
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'created_at',
        'updated_at'
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps();
    }
}
