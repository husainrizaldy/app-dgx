<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocType;

class DocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'SOP',
            'Surat Pengajuan',
            'Dokumen Lain',
        ];

        foreach ($data as $name) {
            DocType::create(['name' => $name]);
        }
    }
}
