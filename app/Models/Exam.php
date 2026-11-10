<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'duration_minutes', 'total_score'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results() {
        return $this->hasMany(\App\Models\Result::class);
    }
    
    
}
