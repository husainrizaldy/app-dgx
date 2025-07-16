<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('member')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'partner_name'                  => 'required|string|max:255',
            'phone_number'                  => 'required|string|max:50',
            'education_level'               => 'required|string|max:100',
            'study_program'                 => 'required|string|max:100',
            'gpu_amount'                    => 'required|numeric',
            'ram_amount'                    => 'required|numeric',
            'storage_amount'                => 'required|numeric',
            'research_type'                 => 'required|string|max:255',
            'research_field'                => 'required|string|max:255',
            'research_description'          => 'nullable|string',
            'data_description'              => 'nullable|string',
            'activity_plan'                 => 'nullable|string',
            'research_output_plan'          => 'nullable|string',
            'previous_research_experience'  => 'nullable|string',
            'supervisor_1'                  => 'nullable|string|max:255',
            'supervisor_2'                  => 'nullable|string|max:255',
            'supervisor_3'                  => 'nullable|string|max:255',
            'research_cost'                 => 'required|string',
            'duration_days'                 => 'required|numeric',
            'shared_data'                   => 'nullable|boolean',
            'proposal_file'                 => 'required|file|mimes:pdf|max:2048',
            'budget_file'                   => 'required|file|mimes:pdf|max:2048',
            'docker_image'                  => 'nullable|url|max:5120',
        ];
    }
}
