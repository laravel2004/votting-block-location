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
        for ($i = 0; $i < 3; $i++) {
            $data[] = [
                'visi' => "To be a Programmer",
                'misi' => "To be a Programmer and Programmer ", 
                "image" => "image/jpg",
                "paslon" => "Raka Gribran", 
                'created_at' => now(),
                'updated_at' => now() 
            ];
        }
        \App\Models\Candidate::insert($data);
    }
}
