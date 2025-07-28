@extends('layouts.app')

@section('title', 'Daftar Mesin')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10 font-urbanist">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">DAFTAR MESIN</h1>
        
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
        <div class="w-11/12 mx-auto overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200 mb-8">

            <table class="w-full table-auto text-left text-sm text-gray-700">
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Nama Mesin</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">URL</th>
                        <th class="px-6 py-4">Token</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($machines as $machine)
                        <tr>
                            <td class="px-6 py-4">{{ $machine['id_container'] }}</td>
                            <td class="px-6 py-4 capitalize">{{ $machine['status'] }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ $machine['url_jupyter'] }}" target="_blank" class="text-blue-600 underline">
                                    {{ $machine['url_jupyter'] }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $machine['token'] }}
                            </div>
                            <td class="px-6 py-4 space-x-2">
                                {{-- <a href="{{ $machine['url_jupyter'] }}?token={{ $machine['token'] }}"
                                target="_blank"
                                class="inline-block px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                                    Masuk Jupyter
                                </a> --}}

                                <form action="{{ route('machine.restart', ['id' => $machine['id_container']]) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            onclick="return confirm('Yakin ingin me-restart mesin {{ $machine['id_container'] }}?')"
                                            class="inline-block px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                        Restart
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada mesin tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</section>
@endsection