<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use HasFactory;
    protected $fillable = ['code_id','location_id','quantita'];
    public function code()
    {
        return $this->belongsTo(Code::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
