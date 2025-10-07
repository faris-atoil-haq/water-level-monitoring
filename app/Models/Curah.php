<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curah extends Model
{
    use HasFactory;
    
    protected $table = 'curah';
    
    protected $fillable = ['curah'];
}
