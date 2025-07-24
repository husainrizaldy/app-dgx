<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ResearchType;

class ResearchTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResearchType::create(['name' => 'Penelitian TA']);
        ResearchType::create(['name' => 'Penelitian Non TA']);
        ResearchType::create(['name' => 'Penelitian Kerjasama Instansi']);
    }
}
