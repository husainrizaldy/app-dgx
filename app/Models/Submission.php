<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'research_type',
        'phone_number',
        'education_level',
        'study_program',
        'gpu_amount',
        'ram_amount',
        'storage_amount',
        'partner_name',
        'supervisor_1',
        'supervisor_2',
        'supervisor_3',
        'duration_days',
        'research_field',
        'research_description',
        'data_description',
        'shared_data',
        'activity_plan',
        'research_output_plan',
        'previous_research_experience',
        'docker_image',
        'research_cost',
        'proposal_file',
        'budget_file',
        'submitted_at',
        'status',
        'is_revised',
    ];

    protected $casts = [
        'shared_data' => 'boolean',
        'submitted_at' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function notes()
    {
        return $this->hasMany(SubmissionNote::class);
    }
}
