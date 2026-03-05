<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    // Tambahkan vision_mission di sini
    protected $fillable = ['name', 'vision_mission'];

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}