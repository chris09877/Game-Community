<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','id'];
    protected $guarded =['id'];

    public function faqs()
{
    return $this->hasMany(Faq::class);
}

public static function getAllCategories()
    {
        return self::all();
    }

    public function getFeedbacks()
    {
        return $this->feedbacks;
    }}
