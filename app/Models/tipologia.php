<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipologia extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'marca_id'];
}