@extends('layouts.app')

@section('title', 'Submission')

@section('content')

<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10">
    <div class="container px-12 py-6">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8 border border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Form Pengajuan Akses</h2>

            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 font-medium text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 font-medium text-sm">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
        
                {{-- Informasi Anggota --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="partner_name" class="block text-sm/6 font-medium text-gray-900">Nama Partner  <span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <input 
                                type="text" 
                                name="partner_name" 
                                id="partner_name" 
                                value="{{ old('partner_name') }}"
                                autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('partner_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
    
                    <div>
                        <label for="phone_number" class="block text-sm/6 font-medium text-gray-900">No. Hp  <span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <input 
                                type="text" 
                                name="phone_number" 
                                id="phone_number" 
                                value="{{ old('phone_number') }}"
                                autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>
        
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="education_level" class="block font-medium text-gray-700">Jenjang Pendidikan  <span class="text-red-500">*</span></label>
                        <input type="text" name="education_level" id="education_level" value="{{ old('education_level') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('education_level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="study_program" class="block font-medium text-gray-700">Program Studi  <span class="text-red-500">*</span></label>
                        <input type="text" name="study_program" id="study_program" value="{{ old('study_program') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('study_program')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
        
                {{-- Spesifikasi Kebutuhan --}}
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label for="gpu_amount" class="block font-medium text-gray-700">Jumlah GPU  <span class="text-red-500">*</span></label>
                        <input type="number" name="gpu_amount" id="gpu_amount" value="{{ old('gpu_amount') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('gpu_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="ram_amount" class="block font-medium text-gray-700">RAM (GB)  <span class="text-red-500">*</span></label>
                        <input type="number" name="ram_amount" id="ram_amount" value="{{ old('ram_amount') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('ram_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="storage_amount" class="block font-medium text-gray-700">Storage (GB)  <span class="text-red-500">*</span></label>
                        <input type="number" name="storage_amount" id="storage_amount" value="{{ old('storage_amount') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('storage_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
        
                {{-- Penelitian --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="research_type" class="block font-medium text-gray-700">Jenis Penelitian  <span class="text-red-500">*</span></label>
                        <input type="text" name="research_type" id="research_type" value="{{ old('research_type') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('research_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="research_field" class="block font-medium text-gray-700">Bidang Penelitian  <span class="text-red-500">*</span></label>
                        <input type="text" name="research_field" id="research_field" value="{{ old('research_field') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('research_field')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                </div>
        
                <div>
                    <label for="research_description" class="block text-sm/6 font-medium text-gray-900">Deskripsi Penelitian</label>
                    <div class="mt-2">
                        <textarea name="research_description" id="research_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('research_description') }}</textarea>
                    </div>
                    <!-- <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about yourself.</p> -->
                </div>
        
                <div>
                    <label for="data_description" class="block text-sm/6 font-medium text-gray-900">Deskripsi Data</label>
                    <div class="mt-2">
                        <textarea name="data_description" id="data_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('data_description') }}</textarea>
                    </div>
                    <!-- <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about yourself.</p> -->
                </div>
        
                {{-- Rencana & Output --}}
                <div>
                    <label for="activity_plan" class="block text-sm/6 font-medium text-gray-900">Rencana Kegiatan</label>
                    <div class="mt-2">
                        <textarea name="activity_plan" id="activity_plan" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('activity_plan') }}</textarea>
                    </div>
                </div>
        
                <div>
                    <label for="research_output_plan" class="block text-sm/6 font-medium text-gray-900">Rencana Output</label>
                    <div class="mt-2">
                        <textarea name="research_output_plan" id="research_output_plan" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('research_output_plan') }}</textarea>
                    </div>
                </div>
        
                <div>
                    <label for="previous_research_experience" class="block text-sm/6 font-medium text-gray-900">Pengalaman Penelitian Sebelumnya</label>
                    <div class="mt-2">
                        <textarea name="previous_research_experience" id="previous_research_experience" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('previous_research_experience') }}</textarea>
                    </div>
                </div>
        
                {{-- Supervisi --}}
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label for="supervisor_1" class="block font-medium text-gray-700">Pembimbing 1</label>
                        <div class="mt-2">
                            <input type="text" name="supervisor_1" id="supervisor_1" value="{{ old('supervisor_1') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                    <div>
                        <label for="supervisor_2" class="block font-medium text-gray-700">Pembimbing 2</label>
                        <div class="mt-2">
                            <input type="text" name="supervisor_2" id="supervisor_2" value="{{ old('supervisor_2') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                    <div>
                        <label for="supervisor_3" class="block font-medium text-gray-700">Pembimbing 3</label>
                        <div class="mt-2">
                            <input type="text" name="supervisor_3" id="supervisor_3" value="{{ old('supervisor_3') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                </div>
        
                {{-- File Upload --}}
                <hr>
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label for="proposal_file" class="block font-medium text-gray-700">Proposal Penelitian (PDF)  <span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <input type="file" name="proposal_file" id="proposal_file" class="form-input w-full rounded border-gray-300">
                            @error('proposal_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="budget_file" class="block font-medium text-gray-700">Rencana Anggaran (PDF)  <span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <input type="file" name="budget_file" id="budget_file" class="form-input w-full rounded border-gray-300">
                            @error('budget_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="docker_image" class="block font-medium text-gray-700">Link Docker Image</label>
                        <div class="mt-2">
                            <input type="url" name="docker_image" id="docker_image" value="{{ old('docker_image') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="https://hub.docker.com/r/username/image:tag">
                        </div>
                    </div>
                </div>
                <hr>
        
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="research_cost" class="block font-medium text-gray-700">Estimasi Biaya Penelitian (Rp)  <span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <input type="text" name="research_cost" id="research_cost" value="{{ old('research_cost') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('research_cost')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="duration_days" class="block font-medium text-gray-700">Durasi Penelitian (hari)  <span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('duration_days')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
        

                <div class="flex gap-3">
                    <div class="flex h-6 shrink-0 items-center">
                        <div class="group grid size-4 grid-cols-1">
                            <input id="shared_data" aria-describedby="shared_data" name="shared_data" type="checkbox" {{ old('shared_data') ? 'checked' : '' }}  
                            class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                            <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm/6">
                        <label for="shared_data" class="font-medium text-gray-900">Konfirmasi data</label>
                        <p id="shared_data" class="text-gray-500">Menggunakan data bersama</p>
                    </div>
                </div>
        
                <div class="pt-4">
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection