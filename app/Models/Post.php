<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public $timestamps = false;
    protected $table = "post";
    protected $primaryKey = 'ID';
    public $incrementing = true; // Indicates if the IDs are auto-incrementing
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Title',
        'Content',
        'images/videos',
        'User',
        'created_at',
        'updated_at'
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
