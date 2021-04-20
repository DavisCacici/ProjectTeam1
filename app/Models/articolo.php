<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articolo extends Model
{
    use HasFactory;
    protected $fillable = ['id','lean','sku','tipologia_id','descrzione'];
}
