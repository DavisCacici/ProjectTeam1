<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $fillable = ['ean','sku','descrizione'];

    public function code()
    {
        return $this->hasMany(Logistic::class);
    }
}
