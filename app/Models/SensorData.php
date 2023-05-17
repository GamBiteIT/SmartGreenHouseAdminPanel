<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;
    protected $fillable = ["season_id","temperature","humidity","soil","light","commentaire"];
    public function season(){
        return $this->belongsTo(Season::class);
    }
}
