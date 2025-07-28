@extends('layouts.app')

@section('title', 'Revisi - Pengajuan Usulan Non TA')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10 font-urbanist">
<div class="container mx-auto">
    {{-- @php
        dd($submission);
    @endphp --}}

    <div class="w-11/12 mx-auto bg-white shadow-md rounded-lg p-8 border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Revisi - Pengajuan Usulan Non TA</h2>
        <form 
            action="{{ route('submission.update.nonta', $submission->uuid) }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col-reverse md:flex-row gap-4">
                <div class="md:basis-2/3">
                    <div class="border border-gray-300 rounded-md p-4">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div>
                                <div class="mb-2">
                                    <label for="researcher_name_2" class="block text-sm/6 font-medium text-gray-700">Nama Peneliti 2</label>
                                    <div class="mt-2">
                                        <input 
                                            type="text" 
                                            name="researcher_name_2" 
                                            id="researcher_name_2" 
                                            value="{{ old('researcher_name_2', $submission->researcher_name_2) }}" 
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="phone_number" class="block text-sm/6 font-medium text-gray-700">No. Hp  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input 
                                            type="number" 
                                            name="phone_number" 
                                            id="phone_number" 
                                            value="{{ old('phone_number', $submission->phone_number) }}"
                                            autocomplete="tel" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                            @error('phone_number')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <label for="education_level" class="block text-sm/6 font-medium text-gray-700">
                                        Jenjang Pendidikan <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-2">
                                        <select 
                                            name="education_level" 
                                            id="education_level"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option value="">-- Pilih Jenjang --</option>
                                            <option value="D3" {{ old('education_level', $submission->education_level) == 'D3' ? 'selected' : '' }}>D3</option>
                                            <option value="S1" {{ old('education_level', $submission->education_level) == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ old('education_level', $submission->education_level) == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ old('education_level', $submission->education_level) == 'S3' ? 'selected' : '' }}>S3</option>
                                            <option value="Profesi" {{ old('education_level') == 'Profesi' ? 'selected' : '' }}>Profesi</option>
                                        </select>
                                        @error('education_level')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="mb-2">
                                    <label for="study_program" class="block text-sm/6 font-medium text-gray-700">Program Studi  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input type="text" name="study_program" id="study_program" value="{{ old('study_program', $submission->study_program) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @error('study_program')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div>
                                <!-- Kolom 3 -->
                                <div class="mb-2">
                                    <label for="gpu_amount" class="block text-sm/6 font-medium text-gray-700">Jumlah GPU  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input type="number" name="gpu_amount" id="gpu_amount" value="{{ old('gpu_amount', $submission->gpu_amount) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @error('gpu_amount')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="ram_amount" class="block text-sm/6 font-medium text-gray-700">RAM (GB)  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input type="number" name="ram_amount" id="ram_amount" value="{{ old('ram_amount', $submission->ram_amount) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @error('ram_amount')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="storage_amount" class="block text-sm/6 font-medium text-gray-700">Storage (GB)  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input type="number" name="storage_amount" id="storage_amount" value="{{ old('storage_amount', $submission->storage_amount) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @error('storage_amount')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="mb-2">
                                    <label for="research_title" class="block text-sm/6 font-medium text-gray-700">Judul / Tema Penelitian  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input type="text" name="research_title" id="research_title" value="{{ old('research_title', $submission->research_title) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @error('research_title')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="research_cost" class="block text-sm/6 font-medium text-gray-700">Estimasi Biaya Penelitian (Rp)  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input type="number" name="research_cost" id="research_cost" value="{{ old('research_cost', $submission->research_cost) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @error('research_cost')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="duration_days" class="block text-sm/6 font-medium text-gray-700">Durasi Penelitian (hari)  <span class="text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days', $submission->duration_days) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @error('duration_days')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:basis-1/3">
                    <div class="border border-gray-300 rounded-md p-4 space-y-4">
                        <!-- Konten kanan -->
                        <div>
                            <div class="mb-2">
                                <label for="research_type_id" class="block text-sm/6 font-medium text-gray-700 mb-2">Jenis Penelitian</label>
                                <p class="font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md py-2 px-4">{{ $submission->researchType->name }}</p>
                            </div>
                            <div class="mb-2">
                                <label for="member_id" class="block text-sm/6 font-medium text-gray-700 mb-2">Nama Peneliti</label>
                                <p class="font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md py-2 px-4">{{ $submission->member->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <p class="font-semibold text-gray-700">Catatan</p>
                        <ul class="space-y-4 max-h-60 overflow-y-auto">
                            @foreach ($submission->notes as $note)
                                <li class="border border-gray-200 rounded p-3 text-sm">
                                    <div class="flex justify-between mb-1">
                                        <span class="font-semibold text-gray-800">{{ ucfirst($note->status) }}</span>
                                        <span class="text-xs text-gray-500">{{ $note->created_at->format('Y-m-d H:i') }}</span>
                                    </div>
                                    <p class="text-gray-700 whitespace-pre-line">{{ $note->note }}</p>
                                    <p class="text-xs text-gray-500 mt-2">Admin: {{ $note->admin->name ?? '-' }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- File Upload --}}
            <hr>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start border border-gray-300 rounded-md p-4 max-w-3xl">
                    <div>
                        <label for="submission_letter_file" class="block text-sm font-medium text-gray-700 mb-1">
                            Surat Pengajuan Penggunaan DGX (PDF) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="file" 
                            name="submission_letter_file" 
                            id="submission_letter_file"
                            accept="application/pdf"
                            class="block w-full text-sm text-gray-900 file:mr-4 file:py-1.5 file:px-4
                                file:rounded-md file:border-0
                                file:bg-purple-600 file:text-white
                                hover:file:bg-purple-700
                                transition"
                        >
                        @error('submission_letter_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            File Lama
                        </label>

                        @if ($submission->submission_letter_file)
                            <a href="{{ asset('storage/submissions/' . $submission->submission_letter_file) }}" 
                                target="_blank" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-purple-700 bg-purple-100 
                                    border border-purple-300 rounded-md hover:bg-purple-200 transition">
                                Lihat / Unduh
                            </a>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada file lama.</p>
                        @endif
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start border border-gray-300 rounded-md p-4 max-w-3xl">
                    <div>
                        <label for="proposal_file" class="block text-sm font-medium text-gray-700 mb-1">
                            Proposal (PDF) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="file" 
                            name="proposal_file" 
                            id="proposal_file"
                            accept="application/pdf"
                            class="block w-full text-sm text-gray-900 file:mr-4 file:py-1.5 file:px-4
                                file:rounded-md file:border-0
                                file:bg-purple-600 file:text-white
                                hover:file:bg-purple-700
                                transition"
                        >
                        @error('proposal_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            File Lama
                        </label>

                        @if ($submission->proposal_file)
                            <a href="{{ asset('storage/submissions/' . $submission->proposal_file) }}" 
                                target="_blank" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-purple-700 bg-purple-100 
                                    border border-purple-300 rounded-md hover:bg-purple-200 transition">
                                Lihat / Unduh
                            </a>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada file lama.</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start border border-gray-300 rounded-md p-4 max-w-3xl">
                    <div>
                        <label for="budget_file" class="block text-sm font-medium text-gray-700 mb-1">
                            Rencana Anggaran (PDF)
                        </label>
                        <input 
                            type="file" 
                            name="budget_file" 
                            id="budget_file"
                            accept="application/pdf"
                            class="block w-full text-sm text-gray-900 file:mr-4 file:py-1.5 file:px-4
                                file:rounded-md file:border-0
                                file:bg-purple-600 file:text-white
                                hover:file:bg-purple-700
                                transition"
                        >
                        @error('budget_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            File Lama
                        </label>

                        @if ($submission->budget_file)
                            <a href="{{ asset('storage/submissions/' . $submission->budget_file) }}" 
                                target="_blank" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-purple-700 bg-purple-100 
                                    border border-purple-300 rounded-md hover:bg-purple-200 transition">
                                Lihat / Unduh
                            </a>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada file lama.</p>
                        @endif
                    </div>
                </div>

                <div class=" max-w-3xl">
                    <label for="docker_image" class="block text-sm/6 font-medium text-gray-700">Link Docker Image</label>
                    <div class="mt-2">
                        <input type="url" name="docker_image" id="docker_image" value="{{ old('docker_image', $submission->docker_image) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="https://hub.docker.com/r/username/image:tag">
                    </div>
                </div>
            </div>
            <hr>

            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label for="research_description" class="block text-sm/6 font-medium text-gray-900">Deskripsi Singkat Penelitian</label>
                    <div class="mt-2">
                        <textarea name="research_description" id="research_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('research_description', $submission->research_description) }}</textarea>
                    </div>
                    <!-- <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about yourself.</p> -->
                </div>

                <div>
                    <label for="data_description" class="block text-sm/6 font-medium text-gray-900">Deskripsi Data</label>
                    <div class="mt-2">
                        <textarea name="data_description" id="data_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('data_description', $submission->data_description) }}</textarea>
                    </div>
                    <!-- <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about yourself.</p> -->
                </div>

                <div>
                    <label for="previous_research_experience" class="block text-sm/6 font-medium text-gray-900">Pengalaman Penelitian Sebelumnya</label>
                    <div class="mt-2">
                        <textarea name="previous_research_experience" id="previous_research_experience" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('previous_research_experience', $submission->previous_research_experience) }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Rencana & Output --}}
                <div>
                    <label for="activity_plan" class="block text-sm/6 font-medium text-gray-900">Rencana Kegiatan</label>
                    <div class="mt-2">
                        <textarea name="activity_plan" id="activity_plan" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('activity_plan', $submission->activity_plan) }}</textarea>
                    </div>
                </div>
        
                <div>
                    <label for="research_output_plan" class="block text-sm/6 font-medium text-gray-900">Rencana Output</label>
                    <div class="mt-2">
                        <textarea name="research_output_plan" id="research_output_plan" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('research_output_plan', $submission->research_output_plan) }}</textarea>
                    </div>
                </div>
            </div>


            <div class="flex gap-3">
                <div class="flex h-6 shrink-0 items-center">
                    <div class="group grid size-4 grid-cols-1">
                        <input id="shared_data" aria-describedby="shared_data" name="shared_data" type="checkbox" {{ old('shared_data', $submission->shared_data) ? 'checked' : '' }}  
                        class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                            <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="text-sm/6">
                    <label for="shared_data" class="font-medium text-gray-900">Konfirmasi Penggunaan Data</label>
                    <p id="shared_data" class="text-gray-500">Menggunakan data bersama</p>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                    Perbahrui Data
                </button>
            </div>
        </form>
    </div>

</div>
</section>
@endsection