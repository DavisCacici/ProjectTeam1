<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articolo extends Model
{
    use HasFactory;
    protected $fillable = ['lean','sku','tipologia_id','marca_id','descrzione'];
}
