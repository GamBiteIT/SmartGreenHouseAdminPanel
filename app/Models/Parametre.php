<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;
    protected $fillable = ["season_id","TemperatureValeur","HumidityValeur","SoilValeur","LightValeur"];

    public function season(){
        return $this->belongsTo(Season::class);
    }
}
