<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';
    protected $fillable = [
        'title', 'fact', 'category_id', 'level', 'language', 'nation', 'image_link', 'source', 'author'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
