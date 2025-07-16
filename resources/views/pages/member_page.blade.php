@extends('layouts.app')

@section('title', 'Status Pengajuan')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10 font-urbanist">
    <div class="container mx-auto px-12 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">STATUS PENGAJUAN</h1>

        {{-- Card Tabel Full Lebar --}}
        <div class="w-full overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200 mb-8">
            <table class="w-full table-auto text-left text-sm text-gray-700">
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Jenis Penelitian</th>
                        <th class="px-6 py-4">Bidang Penelitian</th>
                        <th class="px-6 py-4">Deskripsi Singkat</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($submissions as $submission)
                        <tr>
                            <td class="px-6 py-4">{{ $submission->member->email ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $submission->research_type }}</td>
                            <td class="px-6 py-4">{{ $submission->research_field }}</td>
                            <td class="px-6 py-4">{{ Str::limit($submission->research_description, 80) }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                    @switch($submission->status)
                                        @case('approved') bg-green-100 text-green-700 @break
                                        @case('rejected') bg-red-100 text-red-700 @break
                                        @case('revised')  bg-yellow-100 text-yellow-700 @break
                                        @default bg-gray-100 text-gray-700
                                    @endswitch
                                ">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Belum ada pengajuan penelitian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <a href="{{ url('/submission') }}" class="inline-block px-6 py-3 bg-purple-600 text-white font-semibold rounded hover:bg-purple-700 transition">
                Ajukan Penelitian
            </a>
        </div>
    </div>
</section>


@endsection