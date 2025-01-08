<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juzgado extends Model
{
    protected $table = 'juzgados';
    
    protected $fillable = ['name'];
}
