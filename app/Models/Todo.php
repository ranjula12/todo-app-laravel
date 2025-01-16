<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // Add 'title' to the fillable property
    protected $fillable = ['title', 'completed']; // Ensure both 'title' and 'completed' are fillable
}
