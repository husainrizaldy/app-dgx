<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Notes penggunaan field berdasarkan jenis penelitian:
        // 1 = Penelitian TA
        // 2 = Penelitian Non TA
        // 3 = Penelitian Kerjasama Instansi
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');

            $table->foreignId('research_type_id')->constrained('research_types')->onDelete('restrict'); // 1: TA, 2: Non TA, 3: Instansi

            // Peneliti / Mahasiswa / Tim
            $table->string('researcher_name'); // 1: Nama Mahasiswa, 2: Peneliti 1, 3: Ketua Tim AdHoc
            $table->string('researcher_name_2')->nullable(); // 1: kosong, 2: Peneliti 2, 3: Penanggung Jawab External
            $table->string('researcher_name_3')->nullable(); // 1: kosong 1, 2: kosong, 3: kosong

            $table->string('supervisor_1')->nullable(); // 1: pembimbing 1, 2: Kosong, 3: Kosong
            $table->string('supervisor_2')->nullable(); // 1: pembimbing 1, 2: Kosong, 3: Kosong
            $table->string('supervisor_3')->nullable(); // 1: pembimbing 1, 2: Kosong, 3: Kosong

            // Admin & Posisi AdHoc UG
            $table->string('adhoc_admin_name')->nullable(); // 1: kosong, 2: kosong, 3: Admin Tim AdHoc UG
            $table->string('adhoc_admin_position')->nullable(); // 1: kosong, 2: kosong, 3: Posisi di AdHoc UG

            // Ketua & Penanggung Jawab External
            $table->string('team_leader_name')->nullable(); // 1: kosong, 2: kosong, 3: Ketua Tim AdHoc
            $table->string('external_responsible_name')->nullable(); // 1: kosong, 2: kosong, 3: Penanggung Jawab External
            $table->string('external_institution_name')->nullable(); // 1: kosong, 2: kosong, 3: Nama Institusi External

            // Pendidikan
            $table->string('education_level')->nullable(); // 1: Jenjang Pendidikan, 2: Jenjang Pendidikan, 3: kosong
            $table->string('study_program')->nullable(); // 1: Program Studi, 2: Program Studi, 3: kosong
            $table->string('phone_number'); // 1: Nomor HP, 2: Nomor HP, 3: Nomor HP

            // Resource
            $table->integer('gpu_amount'); // 1: Jumlah GPU, 2: Jumlah GPU, 3: Jumlah GPU
            $table->integer('ram_amount'); // 1: Jumlah RAM, 2: Jumlah RAM, 3: Jumlah RAM
            $table->integer('storage_amount'); // 1: Jumlah Storage, 2: Jumlah Storage, 3: Jumlah Storage
            $table->integer('duration_days'); // 1: Durasi/Hari, 2: Durasi/Hari, 3: Durasi/Hari

            // Judul / Bidang / Bentuk Kegiatan
            $table->string('research_field')->nullable(); // 1: Bidang Penelitian, 2: kosong, 3: kosong
            $table->string('research_title')->nullable(); // 1: kosong, 2: Judul Penelitian, 3: kosong
            $table->string('collaboration_activity_form')->nullable(); // 1: kosong, 2: kosong, 3: Bentuk Kegiatan Kerjasama

            // Deskripsi
            $table->text('research_description')->nullable(); // 1: Deskripsi Penelitian, 2: Deskripsi Penelitian, 3: kosong
            $table->text('data_description')->nullable(); // 1: Deskripsi Data, 2: Deskripsi Data, 3: Deskripsi Data
            $table->boolean('shared_data')->default(false); // 1: Ya/Tidak, 2: Ya/Tidak, 3: Ya/Tidak
            $table->text('activity_plan')->nullable(); // 1: Rencana Kegiatan, 2: Rencana Kegiatan, 3: Rencana Kegiatan
            $table->text('research_output_plan')->nullable(); // 1: Output Penelitian, 2: Output Penelitian, 3: kosong
            $table->text('previous_research_experience')->nullable(); // 1: Pengalaman, 2: Pengalaman, 3: kosong

            // Dokumen Unggah
            $table->string('proposal_file')->nullable(); // 1: Proposal Penelitian, 2: Proposal Penelitian, 3: Proposal Kegiatan
            $table->string('budget_file')->nullable(); // 1: Rencana Anggaran, 2: Rencana Anggaran, 3: Rencana Anggaran
            $table->string('docker_image')->nullable(); // 1: Docker Image, 2: Docker Image, 3: Docker Image
            $table->string('submission_letter_file')->nullable(); // 1: Surat Pengajuan, 2: Surat Pengajuan, 3: Surat Pengajuan

            // Dokumen Kerjasama
            $table->string('collaboration_document')->nullable(); // 1: kosong, 2: kosong, 3: Scan Dokumen Kerjasama
            $table->string('adhoc_team_document')->nullable(); // 1: kosong, 2: kosong, 3: Scan Dokumen Tim AdHoc UG
            $table->string('external_profile_document')->nullable(); // 1: kosong, 2: kosong, 3: Profil Institusi External

            // Biaya
            $table->string('research_cost')->default('0'); // 1: Biaya Penelitian, 2: Biaya Penelitian, 3: Biaya Penelitian

            // Status & Waktu
            $table->timestamp('submitted_at')->default(DB::raw('CURRENT_TIMESTAMP')); // 1/2/3: Tanggal Submit
            $table->enum('status', ['pending', 'revision', 'rejected', 'approved'])->default('pending'); // 1/2/3: Status
            $table->boolean('is_revised')->default(false); // 1/2/3: Revisi Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
