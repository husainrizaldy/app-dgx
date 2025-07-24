<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'research_type_id',
        'researcher_name',
        'researcher_name_2',
        'researcher_name_3',
        'adhoc_admin_name',
        'adhoc_admin_position',
        'team_leader_name',
        'external_responsible_name',
        'external_institution_name',
        'education_level',
        'study_program',
        'phone_number',
        'gpu_amount',
        'ram_amount',
        'storage_amount',
        'duration_days',
        'research_field',
        'research_title',
        'collaboration_activity_form',
        'research_description',
        'data_description',
        'shared_data',
        'activity_plan',
        'research_output_plan',
        'previous_research_experience',
        'proposal_file',
        'budget_file',
        'docker_image',
        'submission_letter_file',
        'collaboration_document',
        'adhoc_team_document',
        'external_profile_document',
        'research_cost',
        'submitted_at',
        'status',
        'is_revised',
    ];

    protected $casts = [
        'shared_data' => 'boolean',
        'is_revised' => 'boolean',
        'submitted_at' => 'datetime',
    ];

    /**
     * Relationship to Member (pembuat submission)
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Relationship to Research Type (jenis penelitian)
     */
    public function researchType()
    {
        return $this->belongsTo(ResearchType::class);
    }

    /**
     * Relationship to Notes
     */
    public function notes()
    {
        return $this->hasMany(SubmissionNote::class);
    }

    public function getFolderByResearchType(): string
    {
        return match ($this->research_type_id) {
            1 => 'ta',
            2 => 'nonta',
            3 => 'instansi',
            default => 'unknown',
        };
    }
}
