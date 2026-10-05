<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'question_ur', 'answer', 'answer_ur', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];
}
