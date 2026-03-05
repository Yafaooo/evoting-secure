<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Candidate::create(['name' => 'Budi Santoso', 'vision_mission' => 'Maju Bersama Teknologi']);
    \App\Models\Candidate::create(['name' => 'Siti Aminah', 'vision_mission' => 'Inovasi Tanpa Batas']);
    }
}
