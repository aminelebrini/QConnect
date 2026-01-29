<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function reponse()
    {
        return $this->belongsTo(Reponse::class, 'reponse_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
