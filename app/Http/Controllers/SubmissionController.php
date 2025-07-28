<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\SubmissionNote;
use App\Models\Member;
use App\Models\Procedure;
use App\Http\Requests\StoreSubmissionRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
        $user = auth('member')->user();
        $userNameSlug = $user->email;

        $url = "https://api-dummy.hpc-hs.my.id/dgx/run/{$userNameSlug}";
        $response = Http::withoutVerifying()->get($url);
        if ($response->successful()) {
            $machines = $response->json('data');
        } else {
            $machines = [];
        }
        return view('pages.list_machine', compact('machines'));
    }

    public function restart($id)
    {
        $response = Http::withoutVerifying()->get("https://api-dummy.hpc-hs.my.id/dgx/restart/{$id}");

        if ($response->successful() && $response->json('error') === false) {
            $message = $response->json('message') ?? "Mesin {$id} berhasil direstart.";
            return redirect()->route('machine.list')->with('success', $message);
        } else {
            $errorMessage = $response->json('message') ?? "Gagal me-restart mesin {$id}.";
            return redirect()->route('machine.list')->with('error', $errorMessage);
        }
    }


    public function list_procedure()
    {
        $procedure = Procedure::get();
        return view('pages.procedure', compact('procedure'));
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

        $validated['proposal_file'] = 'ta/'.$proposal_file_name;
        $validated['budget_file'] = 'ta/'.$budget_file_name;
        $validated['submission_letter_file'] = 'ta/'.$subsfile_name;

        Submission::create($validated);
        return redirect()->route('submission.status')->with('success', 'Pengajuan Proposal TA berhasil dikirim!');
        
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

        $validated['proposal_file'] = 'nonta/'.$proposal_file_name;
        $validated['budget_file'] = 'nonta/'.$budget_file_name;
        $validated['submission_letter_file'] = 'nonta/'.$subsfile_name;


        Submission::create($validated);
        return redirect()->route('submission.status')->with('success', 'Pengajuan Proposal Non TA berhasil dikirim!');
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

        $validated['submission_letter_file'] = 'instansi/'.$subsfile_name;
        $validated['collaboration_document'] = 'instansi/'.$collabs_file_name;
        $validated['adhoc_team_document'] = 'instansi/'.$adtd_file_name;
        $validated['external_profile_document'] = 'instansi/'.$epd_file_name;
        $validated['proposal_file'] = 'instansi/'.$proposal_file_name;
        $validated['budget_file'] = 'instansi/'.$budget_file_name;

        Submission::create($validated);
        
        return redirect()->route('submission.status')->with('success', 'Pengajuan Proposal Instansi berhasil dikirim!');
    }

    public function edit_submission($uuid)
    {
        $submission = Submission::with('notes')->where('uuid', $uuid)->first();

        if (
            ! $submission ||
            $submission->member_id != auth('member')->user()->id ||
            $submission->status !== 'revision'
        ) {
            return redirect()->route('submission.status')
                ->with('error', 'Anda tidak dapat mengakses atau mengedit pengajuan ini.');
        }

        switch ($submission->research_type_id) {
            case 1:
                $view = 'pages.revised.edit-ta';
                break;
            case 2:
                $view = 'pages.revised.edit-nonta';
                break;
            case 3:
                $view = 'pages.revised.edit-instansi';
                break;
            default:
                return redirect()->route('submission.status')
                    ->with('error', 'Jenis penelitian tidak dikenali.');
        }

        return view($view, compact('submission'));
    }

    public function update_ta(Request $request, $uuid)
    {
        // dd($request->all(), $uuid);
        $submission = Submission::where('uuid', $uuid)->first();
        if (
            ! $submission ||
            $submission->member_id != auth('member')->user()->id ||
            $submission->status !== 'revision'
        ) {
            return redirect()->route('submission.status')
                ->with('error', 'Anda tidak dapat mengakses atau mengedit pengajuan ini.');
        }

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
            'submission_letter_file'        => 'nullable',
            'proposal_file'                 => 'nullable',
            'budget_file'                   => 'nullable',
            'docker_image'                  => 'required|url|max:5120',
        ]);

        $validated['shared_data'] = $request->has('shared_data');
        $validated['status'] = 'pending';
        $member = auth('member')->user();
        $member_name = Str::slug($member->name);

        $file_proposal_file = $this->handleUploadedFile($request, $submission, 'proposal_file', 'proposal', $member_name, 'ta');
        
        $file_submission_letter_file = $this->handleUploadedFile($request, $submission, 'submission_letter_file', 'submission_letter_file', $member_name, 'ta');
        
        $file_budget_file = $this->handleUploadedFile($request, $submission, 'budget_file', 'budgets', $member_name, 'ta');
        
        // dd($submission);
        $submission->fill($validated);
        if ($file_proposal_file !== null) {
            $submission->proposal_file = $file_proposal_file;
        }
        if ($file_submission_letter_file !== null) {
            $submission->submission_letter_file = $file_submission_letter_file;
        }
        if ($file_budget_file !== null) {
            $submission->budget_file = $file_budget_file;
        }
        $submission->save();

        return redirect()->route('submission.status')->with('success', 'Revisi Pengajuan TA berhasil dikirim!');
    }

    public function update_nonta(Request $request, $uuid)
    {
        // dd($request->all(), $uuid);
        $submission = Submission::where('uuid', $uuid)->first();
        if (
            ! $submission ||
            $submission->member_id != auth('member')->user()->id ||
            $submission->status !== 'revision'
        ) {
            return redirect()->route('submission.status')
                ->with('error', 'Anda tidak dapat mengakses atau mengedit pengajuan ini.');
        }

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
            'submission_letter_file'        => 'nullable|file',
            'proposal_file'                 => 'nullable|file',
            'budget_file'                   => 'nullable|file',
            'docker_image'                  => 'nullable|url|max:5120',
        ]);

        $validated['status'] = 'pending';
        $validated['shared_data'] = $request->has('shared_data');
        
        $member = auth('member')->user();
        $member_name = Str::slug($member->name);

        $file_proposal_file = $this->handleUploadedFile($request, $submission, 'proposal_file', 'proposal', $member_name, 'nonta');
        
        $file_submission_letter_file = $this->handleUploadedFile($request, $submission, 'submission_letter_file', 'submission_letter_file', $member_name, 'nonta');
        
        $file_budget_file = $this->handleUploadedFile($request, $submission, 'budget_file', 'budgets', $member_name, 'nonta');

        $submission->fill($validated);
        if ($file_proposal_file !== null) {
            $submission->proposal_file = $file_proposal_file;
        }
        if ($file_submission_letter_file !== null) {
            $submission->submission_letter_file = $file_submission_letter_file;
        }
        if ($file_budget_file !== null) {
            $submission->budget_file = $file_budget_file;
        }
        $submission->save();

        return redirect()->route('submission.status')->with('success', 'Revisi Pengajuan Non TA berhasil dikirim!');
    }

    public function update_instansi(Request $request, $uuid)
    {
        // dd($request->all(), $uuid);
        $submission = Submission::where('uuid', $uuid)->first();
        if (
            ! $submission ||
            $submission->member_id != auth('member')->user()->id ||
            $submission->status !== 'revision'
        ) {
            return redirect()->route('submission.status')
                ->with('error', 'Anda tidak dapat mengakses atau mengedit pengajuan ini.');
        }

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
            'collaboration_document'        => 'nullable|file',
            'adhoc_team_document'           => 'nullable|file',
            'external_profile_document'     => 'nullable|file',
            'proposal_file'                 => 'nullable|file',
            'budget_file'                   => 'nullable|file',
            'submission_letter_file'        => 'nullable|file',
            'docker_image'                  => 'nullable|url|max:5120',
        ]);

        $validated['status'] = 'pending';
        $validated['shared_data'] = $request->has('shared_data');
        
        $member = auth('member')->user();
        $member_name = Str::slug($member->name);

        $file_proposal_file = $this->handleUploadedFile($request, $submission, 'proposal_file', 'proposal', $member_name, 'instansi');
        
        $file_submission_letter_file = $this->handleUploadedFile($request, $submission, 'submission_letter_file', 'submission_letter_file', $member_name, 'instansi');
        
        $file_budget_file = $this->handleUploadedFile($request, $submission, 'budget_file', 'budgets', $member_name, 'instansi');


        $file_collaboration_document = $this->handleUploadedFile($request, $submission, 'collaboration_document', 'collaboration_document', $member_name, 'instansi');

        $file_adhoc_team_document = $this->handleUploadedFile($request, $submission, 'adhoc_team_document', 'adhoc_team_document', $member_name, 'instansi');

        $file_external_profile_document = $this->handleUploadedFile($request, $submission, 'external_profile_document', 'external_profile_document', $member_name, 'instansi');


        $submission->fill($validated);
        if ($file_proposal_file !== null) {
            $submission->proposal_file = $file_proposal_file;
        }
        if ($file_submission_letter_file !== null) {
            $submission->submission_letter_file = $file_submission_letter_file;
        }
        if ($file_budget_file !== null) {
            $submission->budget_file = $file_budget_file;
        }
        if ($file_collaboration_document !== null) {
            $submission->collaboration_document = $file_collaboration_document;
        }
        
        if ($file_adhoc_team_document !== null) {
            $submission->adhoc_team_document = $file_adhoc_team_document;
        }
        
        if ($file_external_profile_document !== null) {
            $submission->external_profile_document = $file_external_profile_document;
        }
        $submission->save();

        return redirect()->route('submission.status')->with('success', 'Revisi Pengajuan Usulan Instansi berhasil dikirim!');
    }

    private function handleUploadedFile(
        Request $request,
        Submission $submission,
        string $fieldName,
        string $prefix,
        string $memberName,
        string $folderType
    ): ?string {
        if (! $request->hasFile($fieldName)) {
            return null;
        }

        // Hapus file lama jika ada
        $existingFile = $submission->{$fieldName};
        if ($existingFile && Storage::exists("public/submissions/{$existingFile}")) {
            Storage::delete("public/submissions/{$existingFile}");
        }

        // Simpan file baru
        $file = $request->file($fieldName);
        $ext = $file->getClientOriginalExtension();
        $fileName = "ref_{$folderType}_{$prefix}_" . date('ymdhis') . "_{$memberName}.{$ext}";
        $file->storeAs("submissions/{$folderType}", $fileName, 'public');

        return "{$folderType}/{$fileName}";
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
