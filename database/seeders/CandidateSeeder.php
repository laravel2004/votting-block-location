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
        $paslon1 = [
            'visi' => "To be a Programmer",
            'misi' => "To be a Programmer and Programmer ", 
            "image" => "image/jpg",
            "paslon" => "Anies Baswedan | Muhaimin Iskandar",
            'total_vote' => 1200,
            'created_at' => now(),
            'updated_at' => now() 
        ];
        $paslon2 = [
            'visi' => "To be a Programmer",
            'misi' => "To be a Programmer and Programmer ", 
            "image" => "image/jpg",
            "paslon" => "Prabowo Subianto | Gibran Rakabuming Raka", 
            'total_vote' => 1230,
            'created_at' => now(),
            'updated_at' => now() 
        ];
        $paslon3 = [
            'visi' => "To be a Programmer",
            'misi' => "To be a Programmer and Programmer ", 
            "image" => "image/jpg",
            "paslon" => "Ganjar Pranowo | Mahfud MD", 
            'total_vote' => 2000,
            'created_at' => now(),
            'updated_at' => now() 
        ];
        \App\Models\Candidate::insert($paslon1);
        \App\Models\Candidate::insert($paslon2);
        \App\Models\Candidate::insert($paslon3);
    }
}
