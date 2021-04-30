<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['ean','sku','type_id','brand_id','descrizione'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
