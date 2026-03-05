<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('votes')->delete();
        DB::table('candidates')->delete();

        // Masukkan nama DAN visi misi agar tidak error lagi
        Candidate::create([
            'name' => 'Kandidat 01 - Budi Santoso',
            'vision_mission' => 'Membangun sistem yang transparan dan aman.'
        ]);

        Candidate::create([
            'name' => 'Kandidat 02 - Siti Aminah',
            'vision_mission' => 'Mewujudkan digitalisasi voting yang modern.'
        ]);

        Schema::enableForeignKeyConstraints();
    }
}