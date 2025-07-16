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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->string('research_type');
            $table->string('phone_number');
            $table->string('education_level');
            $table->string('study_program');
            $table->integer('gpu_amount');
            $table->integer('ram_amount');
            $table->integer('storage_amount');
            $table->string('partner_name')->nullable();
            $table->string('supervisor_1')->nullable();
            $table->string('supervisor_2')->nullable();
            $table->string('supervisor_3')->nullable();
            $table->integer('duration_days');
            $table->string('research_field');
            $table->text('research_description');
            $table->text('data_description');
            $table->boolean('shared_data')->default(false);
            $table->text('activity_plan');
            $table->text('research_output_plan');
            $table->text('previous_research_experience')->nullable();
            $table->string('docker_image')->nullable();
            $table->string('research_cost');
            $table->string('proposal_file')->nullable();
            $table->string('budget_file')->nullable();
            // $table->date('submitted_at')->default(now());
            $table->timestamp('submitted_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status', ['pending', 'revision', 'rejected', 'approved'])->default('pending');
            $table->boolean('is_revised')->default(false);
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
