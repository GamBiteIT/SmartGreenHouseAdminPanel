<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = ["name"];

    public function season(){
        return $this->hasMany(Season::class);
    }
}
