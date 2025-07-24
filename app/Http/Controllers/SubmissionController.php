<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\SubmissionNote;
use App\Models\Member;
use App\Http\Requests\StoreSubmissionRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.submission');
    }

    // public function status_submission()
    // {
    //     $member = auth('member')->user();
    //     $submissions = Submission::where('member_id', $member->id)->get();
    //     return view('pages.member_page', compact('submissions'));
    // }

    public function status_submission()
    {
        $member = auth('member')->user();

        $submissions = Submission::where('member_id', $member->id)
            ->with(['notes.admin', 'researchType', 'member'])
            ->get();

        return view('pages.member_page', compact('submissions'));
    }

    public function list_machine()
    {
        return view('pages.list_machine');
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
        
    }

    public function store_ta(Request $request)
    {
        $validated = $request->validate([
            'phone_number'                  => 'required|string|max:50',
            'education_level'               => 'required|string|max:100',
            'study_program'                 => 'required|string|max:100',
            'gpu_amount'                    => 'required|numeric',
            'ram_amount'                    => 'required|numeric',
            'storage_amount'                => 'required|numeric',
            'supervisor_1'                  => 'nullable|string|max:255',
            'supervisor_2'                  => 'nullable|string|max:255',
            'supervisor_3'                  => 'nullable|string|max:255',
            'research_field'                => 'required|string|max:255',
            'research_cost'                 => 'required|string',
            'duration_days'                 => 'required|numeric',
            'research_description'          => 'nullable|string',
            'data_description'              => 'nullable|string',
            'previous_research_experience'  => 'nullable|string',
            'activity_plan'                 => 'nullable|string',
            'research_output_plan'          => 'nullable|string',
            'submission_letter_file'        => 'required',
            'proposal_file'                 => 'required',
            'budget_file'                   => 'required',
            'docker_image'                  => 'nullable|url|max:5120',
        ]);

        $member = auth('member')->user();
        $validated['research_type_id'] = $request->research_type_id;
        $validated['researcher_name'] = $request->researcher_name;
        $validated['member_id'] = $member->id;
        $validated['submitted_at'] = now();
        $validated['status'] = 'pending';
        $validated['is_revised'] = false;
        $validated['shared_data'] = $request->has('shared_data');

        $member_name = Str::slug($member->name);


        if (!$request->hasFile('submission_letter_file')) {
            return redirect()->route('submission.index', ['tab' => 'ta'])
                ->withErrors(['error' => 'File Kerjasama tidak ditemukan, pastikan Anda mengunggah dokumen!']);
        }

        if (!$request->hasFile('proposal_file')) {
            return redirect()->route('submission.index', ['tab' => 'ta'])
                ->withErrors(['error' => 'File Proposal tidak ditemukan, pastikan Anda mengunggah dokumen!']);
        }

        if (!$request->hasFile('budget_file')) {
            return redirect()->route('submission.index', ['tab' => 'ta'])
                ->withErrors(['error' => 'File Rencana Anggaran tidak ditemukan, pastikan Anda mengunggah dokumen!']);
        }


        $proposal_file = $request->file('proposal_file');
        $proposal_file_ext = $proposal_file->extension();
        $proposal_file_fold = 'submissions/ta';
        $proposal_file_name = 'ta'.'_'.'proposal'.'_'.date('ymdhis').'_'.$member_name.'.'.$proposal_file_ext;
        $proposal_file->storeAs(
            $proposal_file_fold,
            $proposal_file_name,
            'public'
        );

        $budget_file = $request->file('budget_file');
        $budget_file_ext = $budget_file->extension();
        $budget_file_fold = 'submissions/ta';
        $budget_file_name = 'ta'.'_'.'budgets'.'_'.date('ymdhis').'_'.$member_name.'.'.$budget_file_ext;
        $budget_file->storeAs(
            $budget_file_fold,
            $budget_file_name,
            'public'
        );

        $subsfile = $request->file('submission_letter_file');
        $subsfile_ext = $subsfile->extension();
        $subsfile_fold = 'submissions/ta';
        $subsfile_name = 'ta'.'_'.'submission_letter_file'.'_'.date('ymdhis').'_'.$member_name.'.'.$subsfile_ext;
        $subsfile->storeAs(
            $subsfile_fold,
            $subsfile_name,
            'public'
        );

        $validated['proposal_file'] = $proposal_file_name;
        $validated['budget_file'] = $budget_file_name;
        $validated['submission_letter_file'] = $subsfile_name;

        Submission::create($validated);
        return redirect()->route('submission.index', ['tab' => 'ta'])->with('success', 'Pengajuan Proposal TA berhasil dikirim!');
        
        // try {

        // } catch (\Throwable $e) {
        //     return redirect()->route('submission.index', ['tab' => 'ta'])
        //         ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
        //         ->withInput();
        // }
    }
    
    public function store_non_ta(Request $request)
    {
        $validated = $request->validate([
            'researcher_name_2'             => 'nullable|string|max:255',
            'research_title'                => 'nullable|string|max:255',
            'phone_number'                  => 'required|string|max:50',
            'education_level'               => 'required|string|max:100',
            'study_program'                 => 'required|string|max:100',
            'gpu_amount'                    => 'required|numeric',
            'ram_amount'                    => 'required|numeric',
            'storage_amount'                => 'required|numeric',
            'research_cost'                 => 'required|string',
            'duration_days'                 => 'required|numeric',
            'research_description'          => 'nullable|string',
            'data_description'              => 'nullable|string',
            'previous_research_experience'  => 'nullable|string',
            'activity_plan'                 => 'nullable|string',
            'research_output_plan'          => 'nullable|string',
            'submission_letter_file'        => 'required|file',
            'proposal_file'                 => 'required|file',
            'budget_file'                   => 'required|file',
            'docker_image'                  => 'nullable|url|max:5120',
        ]);

        $member = auth('member')->user();
        $validated['research_type_id'] = $request->research_type_id;
        $validated['researcher_name'] = $request->researcher_name;
        $validated['member_id'] = $member->id;
        $validated['submitted_at'] = now();
        $validated['status'] = 'pending';
        $validated['is_revised'] = false;
        $validated['shared_data'] = $request->has('shared_data');

        $member_name = Str::slug($member->name);

        if (!$request->hasFile('submission_letter_file')) {
            return redirect()->route('submission.index', ['tab' => 'non-ta'])
                ->withErrors(['error' => 'File Kerjasama tidak ditemukan, pastikan Anda mengunggah dokumen!']);
        }

        if (!$request->hasFile('proposal_file')) {
            return redirect()->route('submission.index', ['tab' => 'non-ta'])
                ->withErrors(['error' => 'File Proposal tidak ditemukan, pastikan Anda mengunggah dokumen!']);
        }

        if (!$request->hasFile('budget_file')) {
            return redirect()->route('submission.index', ['tab' => 'non-ta'])
                ->withErrors(['error' => 'File Rencana Anggaran tidak ditemukan, pastikan Anda mengunggah dokumen!']);
        }


        $proposal_file = $request->file('proposal_file');
        $proposal_file_ext = $proposal_file->extension();
        $proposal_file_fold = 'submissions/nonta';
        $proposal_file_name = 'non-ta'.'_'.'proposal'.'_'.date('ymdhis').'_'.$member_name.'.'.$proposal_file_ext;
        $proposal_file->storeAs(
            $proposal_file_fold,
            $proposal_file_name,
            'public'
        );

        $budget_file = $request->file('budget_file');
        $budget_file_ext = $budget_file->extension();
        $budget_file_fold = 'submissions/nonta';
        $budget_file_name = 'non-ta'.'_'.'budgets'.'_'.date('ymdhis').'_'.$member_name.'.'.$budget_file_ext;
        $budget_file->storeAs(
            $budget_file_fold,
            $budget_file_name,
            'public'
        );

        $subsfile = $request->file('submission_letter_file');
        $subsfile_ext = $subsfile->extension();
        $subsfile_fold = 'submissions/nonta';
        $subsfile_name = 'non-ta'.'_'.'submission_letter_file'.'_'.date('ymdhis').'_'.$member_name.'.'.$subsfile_ext;
        $subsfile->storeAs(
            $subsfile_fold,
            $subsfile_name,
            'public'
        );

        $validated['proposal_file'] = $proposal_file_name;
        $validated['budget_file'] = $budget_file_name;
        $validated['submission_letter_file'] = $subsfile_name;


        Submission::create($validated);
        return redirect()->route('submission.index', ['tab' => 'non-ta'])->with('success', 'Pengajuan Proposal Non TA berhasil dikirim!');
    }
    
    public function store_instansi(Request $request)
    {
        $validated = $request->validate([
            'phone_number'                  => 'required|string|max:50',
            'adhoc_admin_name'              => 'nullable|string|max:255',
            'adhoc_admin_position'          => 'nullable|string|max:255',
            'team_leader_name'              => 'nullable|string|max:255',
            'external_responsible_name'     => 'nullable|string|max:255',
            'external_institution_name'     => 'nullable|string|max:255',
            'gpu_amount'                    => 'required|numeric',
            'ram_amount'                    => 'required|numeric',
            'storage_amount'                => 'required|numeric',
            'research_cost'                 => 'required|string',
            'duration_days'                 => 'required|numeric',
            'data_description'              => 'nullable|string',
            'activity_plan'                 => 'nullable|string',
            'collaboration_activity_form'   => 'nullable|string',
            'collaboration_document'        => 'required|file',
            'adhoc_team_document'           => 'required|file',
            'external_profile_document'     => 'required|file',
            'proposal_file'                 => 'required|file',
            'budget_file'                   => 'required|file',
            'submission_letter_file'        => 'required|file',
            'docker_image'                  => 'nullable|url|max:5120',
        ]);

        $member = auth('member')->user();
        $validated['research_type_id'] = $request->research_type_id;
        $validated['member_id'] = $member->id;
        $validated['researcher_name'] = $member->name;
        $validated['submitted_at'] = now();
        $validated['status'] = 'pending';
        $validated['is_revised'] = false;
        $validated['shared_data'] = $request->has('shared_data');

        $member_name = Str::slug($member->name);

        $subsfile = $request->file('submission_letter_file');
        $subsfile_ext = $subsfile->extension();
        $subsfile_fold = 'submissions/instansi';
        $subsfile_name = 'instansi'.'_'.'submission_letter_file'.'_'.date('ymdhis').'_'.$member_name.'.'.$subsfile_ext;
        $subsfile->storeAs(
            $subsfile_fold,
            $subsfile_name,
            'public'
        );

        $collabs_file = $request->file('collaboration_document');
        $collabs_file_ext = $collabs_file->extension();
        $collabs_file_fold = 'submissions/instansi';
        $collabs_file_name = 'instansi'.'_'.'collaboration_document'.'_'.date('ymdhis').'_'.$member_name.'.'.$collabs_file_ext;
        $collabs_file->storeAs(
            $collabs_file_fold,
            $collabs_file_name,
            'public'
        );

        $adtd_file = $request->file('adhoc_team_document');
        $adtd_file_ext = $adtd_file->extension();
        $adtd_file_fold = 'submissions/instansi';
        $adtd_file_name = 'instansi'.'_'.'adhoc_team_document'.'_'.date('ymdhis').'_'.$member_name.'.'.$adtd_file_ext;
        $adtd_file->storeAs(
            $adtd_file_fold,
            $adtd_file_name,
            'public'
        );

        $epd_file = $request->file('external_profile_document');
        $epd_file_ext = $epd_file->extension();
        $epd_file_fold = 'submissions/instansi';
        $epd_file_name = 'instansi'.'_'.'external_profile_document'.'_'.date('ymdhis').'_'.$member_name.'.'.$epd_file_ext;
        $epd_file->storeAs(
            $epd_file_fold,
            $epd_file_name,
            'public'
        );

        $proposal_file = $request->file('proposal_file');
        $proposal_file_ext = $proposal_file->extension();
        $proposal_file_fold = 'submissions/instansi';
        $proposal_file_name = 'instansi'.'_'.'proposal'.'_'.date('ymdhis').'_'.$member_name.'.'.$proposal_file_ext;
        $proposal_file->storeAs(
            $proposal_file_fold,
            $proposal_file_name,
            'public'
        );

        $budget_file = $request->file('budget_file');
        $budget_file_ext = $budget_file->extension();
        $budget_file_fold = 'submissions/instansi';
        $budget_file_name = 'instansi'.'_'.'budgets'.'_'.date('ymdhis').'_'.$member_name.'.'.$budget_file_ext;
        $budget_file->storeAs(
            $budget_file_fold,
            $budget_file_name,
            'public'
        );

        $validated['submission_letter_file'] = $subsfile_name;
        $validated['collaboration_document'] = $collabs_file_name;
        $validated['adhoc_team_document'] = $adtd_file_name;
        $validated['external_profile_document'] = $epd_file_name;
        $validated['proposal_file'] = $proposal_file_name;
        $validated['budget_file'] = $budget_file_name;

        Submission::create($validated);
        
        return redirect()->route('submission.index', ['tab' => 'instansi'])->with('success', 'Pengajuan Proposal Instansi berhasil dikirim!');
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
