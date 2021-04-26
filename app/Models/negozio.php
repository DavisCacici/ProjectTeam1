<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class negozio extends Model
{
    use HasFactory;
    protected $fillable = ['articolo_id'];

    public function articolo()
    {
        return $this->belongsTo(articolo::class);
    }
}
