<x-filament::page>
    <x-filament::card class="p-0"> {{-- hilangkan padding bawaan agar tabel bisa benar-benar lebar --}}
        <div class="overflow-x-auto"> {{-- agar tetap responsive di layar kecil --}}
            <table class="w-full table-auto divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-gray-600 font-semibold">
                    <tr>
                        <th class="px-6 py-3">Nama Mesin</th>
                        <th class="px-6 py-3">Deskripsi</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">GPU</th>
                        <th class="px-6 py-3 text-center">MIG/GPU</th>
                        <th class="px-6 py-3">URL</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($this->mesins as $mesin)
                        <tr>
                            <td class="px-6 py-4 text-gray-900">{{ $mesin['nama_mesin'] }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $mesin['description'] }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium
                                    {{ $mesin['status'] === 'active' ? 'bg-success-100 text-success-700' : 'bg-danger-100 text-danger-700' }}">
                                    {{ ucfirst($mesin['status']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-800">{{ $mesin['gpu'] }}</td>
                            <td class="px-6 py-4 text-center text-gray-800">{{ $mesin['mig_pergpu'] }}</td>
                            <td class="px-6 py-4">
                                @if (!empty($mesin['url']))
                                    <a href="{{ $mesin['url'] }}" target="_blank" class="text-primary-600 hover:underline">Buka</a>
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">Tidak ada data mesin ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::card>
</x-filament::page>
