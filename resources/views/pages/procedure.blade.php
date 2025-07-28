@extends('layouts.app')

@section('title', 'Prosedur')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10 font-urbanist">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">DAFTAR PROSEDUR</h1>
        <div class="w-11/12 mx-auto overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200 mb-8">
            <table class="w-full table-auto text-left text-sm text-gray-700">
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Jenis Penelitian</th>
                        <th class="px-6 py-4">Jenis Dokumen</th>
                        <th class="px-6 py-4">File</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($procedure as $pro)
                        <tr>
                            <td class="px-6 py-4">{{ $pro->researchType->name }}</td>
                            <td class="px-6 py-4">{{ $pro->docType->name }}</td>
                            <td class="px-6 py-4">
                                @if($pro->files)
                                    <a href="{{ asset('storage/' . $pro->files) }}" 
                                    target="_blank"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</section>
@endsection