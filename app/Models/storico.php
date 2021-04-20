<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storico extends Model
{
    use HasFactory;
    protected $fillable = ['articolo_id', 'data'];
}
