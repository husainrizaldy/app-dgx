<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\SubmissionNote;
use App\Models\Member;
use App\Http\Requests\StoreSubmissionRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.submission');
    }

    public function status_submission()
    {
        $member = auth('member')->user();
        $submissions = Submission::where('member_id', $member->id)->get();
        return view('pages.member_page', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd('masuk', $request->all());
            $validated = $request->validate([
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
                'proposal_file'                 => 'required',
                'budget_file'                   => 'required',
                'docker_image'                  => 'nullable|url|max:5120',
            ]);


            $member = auth('member')->user();
            $validated['member_id'] = $member->id;
            $validated['submitted_at'] = now();
            $validated['status'] = 'pending';
            $validated['is_revised'] = false;
            $validated['shared_data'] = $request->has('shared_data');

            $member_name = Str::slug($member->name);
            
            if (!$request->hasFile('proposal_file')) {
                return back()->withErrors(['error' => 'File Proposal tidak ditemukan, pastikan Anda mengunggah dokumen!']);
            }
            if (!$request->hasFile('budget_file')) {
                return back()->withErrors(['error' => 'File Rencana Anggaran tidak ditemukan, pastikan Anda mengunggah dokumen!']);
            }

            $proposal_file = $request->file('proposal_file');
            $proposal_file_ext = $proposal_file->extension();
            $proposal_file_fold = 'submissions/proposals';
            $proposal_file_name = 'proposal'.'_'.date('ymdhis').'_'.$member_name.'.'.$proposal_file_ext;
            $proposal_file->storeAs(
                $proposal_file_fold,
                $proposal_file_name,
                'public'
            );

            $budget_file = $request->file('budget_file');
            $budget_file_ext = $budget_file->extension();
            $budget_file_fold = 'submissions/budgets';
            $budget_file_name = 'budgets'.'_'.date('ymdhis').'_'.$member_name.'.'.$budget_file_ext;
            $budget_file->storeAs(
                $budget_file_fold,
                $budget_file_name,
                'public'
            );

            $validated['proposal_file'] = $proposal_file_name;
            $validated['budget_file'] = $budget_file_name;

            // dd('lewat validated', $validated);

            Submission::create($validated);

            return redirect()->back()->with('success', 'Pengajuan berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
