<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{

    use HasFactory;
    protected $fillable = ["name","plant_id","start_day","end_day","quantity_planty","expected_productivity","4season","productivity"];

    public function parametres(){
        return $this->hasOne(Parametre::class);
    }
    public function sensordata(){
        return $this->hasMany(SensorData::class);
    }
    public function extra(){
        return $this->hasMany(Additional::class);
    }
    public function plant(){
        return $this->belongsTo(Plant::class);
    }
    public function device(){
        return $this->hasMany(Devices::class);
    }

}
