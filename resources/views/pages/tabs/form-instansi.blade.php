<div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Formulir Pengajuan Usulan Instansi</h2>

{{-- @dd(Auth::guard('member')->user()->id); --}}
    <form action="{{ route('submission.store.instansi', ['tab' => 'instansi']) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <div class="mb-2">
                    <label for="research_type_id" class="block text-sm/6 font-medium text-gray-700">Jenis Penelitian</label>
                    <div class="mt-2">
                        <input type="hidden" name="research_type_id" value="3">
                        <input 
                            type="text"
                            id="research_type_id_display"
                            value="Penelitian Kerjasama Instansi"
                            readonly
                            class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 sm:text-sm/6 cursor-not-allowed" />
                    </div>
                </div>
                <div class="mb-2">
                    <label for="phone_number" class="block text-sm/6 font-medium text-gray-700">No. Hp  <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input 
                            type="number" 
                            name="phone_number" 
                            id="phone_number" 
                            value="{{ old('phone_number') }}"
                            autocomplete="tel" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
                
                <div class="mb-2">
                    <label for="adhoc_admin_name" class="block text-sm/6 font-medium text-gray-700">Nama Admin Tim AdHoc Internal UG  <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" name="adhoc_admin_name" id="adhoc_admin_name" value="{{ old('adhoc_admin_name') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('adhoc_admin_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
    
                <div class="mb-2">
                    <label for="adhoc_admin_position" class="block text-sm/6 font-medium text-gray-700">Posisi dalam Tim AdHoc Internal  <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" name="adhoc_admin_position" id="adhoc_admin_position" value="{{ old('adhoc_admin_position') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('adhoc_admin_position')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>
            <div>
                <input type="hidden" name="member_id" value="{{ Auth::guard('member')->user()->id }}">

                <div class="mb-2">
                    <label for="team_leader_name" class="block text-sm/6 font-medium text-gray-700">Nama Ketua Tim AdHoc</label>
                    <div class="mt-2">
                        <input 
                            type="text" 
                            name="team_leader_name" 
                            id="team_leader_name" 
                            value="{{ old('team_leader_name') }}" 
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('team_leader_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <label for="external_responsible_name" class="block text-sm/6 font-medium text-gray-700">Nama Penanggung Jawab External</label>
                    <div class="mt-2">
                        <input 
                            type="text" 
                            name="external_responsible_name" 
                            id="external_responsible_name" 
                            value="{{ old('external_responsible_name') }}" 
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('external_responsible_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
                
                <div class="mb-2">
                    <label for="external_institution_name" class="block text-sm/6 font-medium text-gray-700">Nama Institusi Eksternal</label>
                    <div class="mt-2">
                        <input 
                            type="text" 
                            name="external_institution_name" 
                            id="external_institution_name" 
                            value="{{ old('external_institution_name') }}" 
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('external_institution_name')
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
                        <input type="number" name="gpu_amount" id="gpu_amount" value="{{ old('gpu_amount') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('gpu_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <label for="ram_amount" class="block text-sm/6 font-medium text-gray-700">RAM (GB)  <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="number" name="ram_amount" id="ram_amount" value="{{ old('ram_amount') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('ram_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <label for="storage_amount" class="block text-sm/6 font-medium text-gray-700">Storage (GB)  <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="number" name="storage_amount" id="storage_amount" value="{{ old('storage_amount') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('storage_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <div class="mb-2">
                    <label for="research_cost" class="block text-sm/6 font-medium text-gray-700">Estimasi Biaya Penelitian (Rp)  <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="number" name="research_cost" id="research_cost" value="{{ old('research_cost') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('research_cost')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <label for="duration_days" class="block text-sm/6 font-medium text-gray-700">Durasi Penelitian (hari)  <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('duration_days')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- File Upload --}}
        <hr>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label for="submission_letter_file" class="block text-sm/6 font-medium text-gray-700">
                    Surat Pengajuan Penggunaan DGX (PDF) <span class="text-red-500">*</span>
                </label>
                <div class="mt-2">
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
            </div>
            <div>
                <label for="collaboration_document" class="block text-sm/6 font-medium text-gray-700">
                    Scan Dokumen Kerjasama (PDF) <span class="text-red-500">*</span>
                </label>
                <div class="mt-2">
                    <input 
                        type="file" 
                        name="collaboration_document" 
                        id="collaboration_document"
                        accept="application/pdf"
                        class="block w-full text-sm text-gray-900 file:mr-4 file:py-1.5 file:px-4
                            file:rounded-md file:border-0
                            file:bg-purple-600 file:text-white
                            hover:file:bg-purple-700
                            transition"
                    >
                    @error('collaboration_document')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="adhoc_team_document" class="block text-sm/6 font-medium text-gray-700">
                    Scan Dokumen Tim AdHoc UG (PDF) <span class="text-red-500">*</span>
                </label>
                <div class="mt-2">
                    <input 
                        type="file" 
                        name="adhoc_team_document" 
                        id="adhoc_team_document"
                        accept="application/pdf"
                        class="block w-full text-sm text-gray-900 file:mr-4 file:py-1.5 file:px-4
                            file:rounded-md file:border-0
                            file:bg-purple-600 file:text-white
                            hover:file:bg-purple-700
                            transition"
                    >
                    @error('adhoc_team_document')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            
            <div>
                <label for="external_profile_document" class="block text-sm/6 font-medium text-gray-700">
                    Profil Institusi External (Pdf) <span class="text-red-500">*</span>
                </label>
                <div class="mt-2">
                    <input 
                        type="file" 
                        name="external_profile_document" 
                        id="external_profile_document"
                        accept="application/pdf"
                        class="block w-full text-sm text-gray-900 file:mr-4 file:py-1.5 file:px-4
                            file:rounded-md file:border-0
                            file:bg-purple-600 file:text-white
                            hover:file:bg-purple-700
                            transition"
                    >
                    @error('external_profile_document')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="proposal_file" class="block text-sm/6 font-medium text-gray-700">
                    Proposal Kegiatan (PDF) <span class="text-red-500">*</span>
                </label>
                <div class="mt-2">
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
            </div>

            <div>
                <label for="budget_file" class="block text-sm/6 font-medium text-gray-700">
                    Rencana Anggaran (PDF)
                </label>
                <div class="mt-2">
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
            </div>
            <div>
                <label for="docker_image" class="block text-sm/6 font-medium text-gray-700">Link Docker Image</label>
                <div class="mt-2">
                    <input type="url" name="docker_image" id="docker_image" value="{{ old('docker_image') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="https://hub.docker.com/r/username/image:tag">
                </div>
            </div>
        </div>
        <hr>

        <div class="grid md:grid-cols-3 gap-6">
            <div>
                <label for="data_description" class="block text-sm/6 font-medium text-gray-900">Deskripsi Data</label>
                <div class="mt-2">
                    <textarea name="data_description" id="data_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('data_description') }}</textarea>
                </div>
                <!-- <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about yourself.</p> -->
            </div>
            <div>
                <label for="activity_plan" class="block text-sm/6 font-medium text-gray-900">Rencana Kegiatan</label>
                <div class="mt-2">
                    <textarea name="activity_plan" id="activity_plan" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('activity_plan') }}</textarea>
                </div>
            </div>
            <div>
                <label for="collaboration_activity_form" class="block text-sm/6 font-medium text-gray-900">Bentuk Kegiatan Kerjasama</label>
                <div class="mt-2">
                    <textarea name="collaboration_activity_form" id="collaboration_activity_form" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('collaboration_activity_form') }}</textarea>
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
                <label for="shared_data" class="font-medium text-gray-900">Konfirmasi Penggunaan Data</label>
                <p id="shared_data" class="text-gray-500">Menggunakan data bersama</p>
            </div>
        </div>

        @php
            $checklist = [
                'Saya bersedia mematuhi tata cara penggunaan DGX yang telah ditetapkan, dan tidak akan memindahkan account login ke orang lain',
                'Saya akan mengumpulkan laporan akhir pada masa berakhirnya penggunaan DGX pada penelitian',
                'Saya telah mencoba membuat docker sesuai kebutuhan penggunaan di DGX dan akan mengirimkan kepada Tim Pengembangan DGX',
            ];
        @endphp

        <div class="space-y-3 mb-6">
            @foreach ($checklist as $key => $item)
                <div class="flex items-start gap-2">
                    <input 
                        type="checkbox" 
                        id="check{{ $key }}" 
                        class="mt-1.5 border-gray-300 text-purple-600 focus:ring-purple-500"
                    >
                    <label for="check{{ $key }}" class="text-sm text-gray-700">{{ $item }}</label>
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>