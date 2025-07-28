@extends('layouts.app')

@section('title', 'Status Pengajuan')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10 font-urbanist">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">STATUS PENGAJUAN</h1>
        @foreach (['success' => 'green', 'error' => 'red'] as $type => $color)
            @if (session($type))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    class="w-11/12 mx-auto mb-4 p-3 rounded bg-{{ $color }}-100 text-{{ $color }}-800 font-medium text-sm relative"
                >
                    {{ session($type) }}
                    <button 
                        @click="show = false"
                        class="absolute top-3 right-5 text-{{ $color }}-800 hover:text-{{ $color }}-900"
                    >
                        X
                    </button>
                </div>
            @endif
        @endforeach
        {{-- Card Tabel Full Lebar --}}
        <div class="w-11/12 mx-auto overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200 mb-8">
            <table class="w-full table-auto text-left text-sm text-gray-700">
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Jenis Penelitian</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Revisi</th>
                        <th class="px-6 py-4">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($submissions as $submission)
                        <tr x-data="{ open: false }">
                            <td class="px-6 py-4">{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4">{{ $submission->member->email ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $submission->researchType->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                    @switch($submission->status)
                                        @case('approved') bg-green-100 text-green-700 @break
                                        @case('rejected') bg-red-100 text-red-700 @break
                                        @case('revision')  bg-yellow-100 text-yellow-700 @break
                                        @default bg-gray-100 text-gray-700
                                    @endswitch
                                ">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($submission->status === 'revision')
                                    <a href="{{ route('submission.edit', $submission->uuid) }}"
                                    target="_blank"
                                    class="inline-block px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 transition">
                                        Revisi
                                    </a>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button 
                                    type="button"
                                    @click="open = true" 
                                    class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-700 transition"
                                >
                                    Catatan
                                </button>

                                <!-- Modal -->
                                <div 
                                    x-show="open" 
                                    x-cloak 
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                >
                                    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                                        <h2 class="text-lg font-semibold mb-4">Catatan</h2>

                                        @if ($submission->notes->isEmpty())
                                            <p class="text-sm text-gray-700">Tidak ada catatan.</p>
                                        @else
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
                                        @endif

                                        <div class="mt-6 text-right">
                                            <button 
                                                @click="open = false" 
                                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-sm font-medium"
                                            >
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
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