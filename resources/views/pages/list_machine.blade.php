@extends('layouts.app')

@section('title', 'Daftar Mesin')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10 font-urbanist">
    <div class="container px-10 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">DAFTAR MESIN</h1>

        <div class="w-full overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200 mb-8">
            <table class="w-full table-auto text-left text-sm text-gray-700">
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">ID Container</th>
                        <th class="px-6 py-4">URL Jupyter</th>
                        <th class="px-6 py-4">Token</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $machines = [
                            [
                                'id_container' => 'jupyter-001',
                                'url' => 'http://jupyter.local/001',
                                'token' => 'abc123token',
                                'status' => 'running',
                            ],
                            [
                                'id_container' => 'jupyter-002',
                                'url' => 'http://jupyter.local/002',
                                'token' => 'xyz456token',
                                'status' => 'stopped',
                            ],
                            [
                                'id_container' => 'jupyter-003',
                                'url' => 'http://jupyter.local/003',
                                'token' => 'token789ghi',
                                'status' => 'provisioning',
                            ],
                            [
                                'id_container' => 'jupyter-004',
                                'url' => 'http://jupyter.local/004',
                                'token' => 'token000err',
                                'status' => 'error',
                            ],
                            [
                                'id_container' => 'jupyter-005',
                                'url' => 'http://jupyter.local/005',
                                'token' => 'tokenfreeze321',
                                'status' => 'suspended',
                            ],
                        ];
                    @endphp

                    @foreach ($machines as $machine)
                        <tr>
                            <td class="px-6 py-4">{{ $machine['id_container'] }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ $machine['url'] }}" class="text-blue-600 hover:underline" target="_blank">
                                    {{ $machine['url'] }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ $machine['token'] }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                    @switch($machine['status'])
                                        @case('running') bg-green-100 text-green-700 @break
                                        @case('stopped') bg-gray-100 text-gray-700 @break
                                        @case('provisioning') bg-yellow-100 text-yellow-700 @break
                                        @case('error') bg-red-100 text-red-700 @break
                                        @case('suspended') bg-blue-100 text-blue-700 @break
                                        @default bg-gray-100 text-gray-700
                                    @endswitch
                                ">
                                    {{ ucfirst($machine['status']) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</section>
@endsection