<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Submission;

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        Submission::create([
            'member_id' => 1,
            'research_type' => 'AI Optimization',
            'phone_number' => '081234567890',
            'education_level' => 'S2',
            'study_program' => 'Teknik Informatika',
            'gpu_amount' => 2,
            'ram_amount' => 64,
            'storage_amount' => 100,
            'partner_name' => 'John Doe Eduard',
            'supervisor_1' => 'Dr. Andi',
            'supervisor_2' => null,
            'supervisor_3' => null,
            'duration_days' => 90,
            'research_field' => 'Computer Vision',
            'research_description' => 'Penelitian terkait deteksi objek real-time.',
            'data_description' => 'Dataset berisi 100.000 gambar hasil drone.',
            'shared_data' => true,
            'activity_plan' => 'Pelatihan model -> Evaluasi -> Laporan',
            'research_output_plan' => 'Publikasi jurnal & laporan hasil',
            'previous_research_experience' => 'Pernah melakukan riset dengan data satelit.',
            'docker_image' => 'cv-ai:v1.2',
            'research_cost' => 15000000,
            'proposal_file' => 'proposal_ai_optimization.pdf',
            'budget_file' => 'budget_ai_optimization.xlsx',
            'submitted_at' => Carbon::now()->subDays(5),
            'status' => 'pending',
            'is_revised' => false,
        ]);

        Submission::create([
            'member_id' => 2,
            'research_type' => 'Natural Language Processing',
            'phone_number' => '082233445566',
            'education_level' => 'S3',
            'study_program' => 'Ilmu Komputer',
            'gpu_amount' => 4,
            'ram_amount' => 128,
            'storage_amount' => 250,
            'partner_name' => 'Khanza Sihab',
            'supervisor_1' => 'Prof. Sinta',
            'supervisor_2' => 'Dr. Budi',
            'supervisor_3' => null,
            'duration_days' => 120,
            'research_field' => 'Large Language Models',
            'research_description' => 'Studi pengembangan model bahasa domain industri.',
            'data_description' => 'Data teks industri hasil crawling internal PT Freeport.',
            'shared_data' => false,
            'activity_plan' => 'Crawling data -> Preprocessing -> Training -> Evaluasi',
            'research_output_plan' => 'Publikasi ilmiah & pengembangan produk NLP',
            'previous_research_experience' => 'Riset NLP bidang hukum & kesehatan.',
            'docker_image' => 'nlp-industrial:v3.0',
            'research_cost' => 35000000,
            'proposal_file' => 'proposal_nlp_industri.pdf',
            'budget_file' => 'budget_nlp_industri.xlsx',
            'submitted_at' => Carbon::now()->subDays(2),
            'status' => 'pending',
            'is_revised' => false,
        ]);
    }
}
