<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answer';
    protected $fillable = [
        'content', 'is_correct', 'quiz_id'
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
