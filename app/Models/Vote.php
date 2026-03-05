<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    // Ini bagian yang tadi kurang, kita kasih izin untuk kolom-kolom ini
    protected $fillable = ['id', 'candidate_id', 'voter_hash', 'signature'];

    // Karena kita pakai UUID (bukan angka 1,2,3), kita harus tambahkan ini
    public $incrementing = false;
    protected $keyType = 'string';
}