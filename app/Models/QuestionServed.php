<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionServed extends Model
{
    use HasFactory;
    protected $table = "question_to_user";
}