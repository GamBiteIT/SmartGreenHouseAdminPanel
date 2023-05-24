<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = ["name","type","duree_de_plontation","productivity"];

    public function season(){
        return $this->hasMany(Season::class);
    }
}
