<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    use HasFactory;
    protected $fillable = [
        'title',
        'text',
        'category_id',
        'user_id',
        'created_at',
        'updated_at'
       
        
    ];
    
}
