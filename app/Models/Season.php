<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{

    use HasFactory;
    protected $fillable = ["name","plant","duree","4season","productivity"];

    public function parametres(){
        return $this->hasOne(Parametre::class);
    }
    public function sensordata(){
        return $this->hasMany(SensorData::class);
    }
    public function extra(){
        return $this->hasMany(Additional::class);
    }
}
