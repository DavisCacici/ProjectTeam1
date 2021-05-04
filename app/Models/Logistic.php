<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//definiione del modello legato alla tabella Logistics
class Logistic extends Model
{
    use HasFactory;
    protected $fillable = ['code_id','location_id','quantita'];
    //stabilisce i vincoli di foregin Key con la tabella Code
    public function code()
    {
        return $this->belongsTo(Code::class);
    }
    //stabilisce i vincoli di foregin Key con la tabella location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
