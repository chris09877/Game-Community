<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'faq';
    protected $fillable = [
        'title',
        'text',
        'categories',
        'userID',
       
        
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
