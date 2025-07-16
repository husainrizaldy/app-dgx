@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] flex items-center pt-28 pb-10">
    <div class="container mx-auto px-12">
        <div class="flex flex-col md:flex-row items-center">

            <div class="w-full md:w-1/2 mb-10 md:mb-0 text-left font-urbanist">
                {{-- <h3 class="text-lg text-purple-700 font-semibold uppercase tracking-wide">
                    Selamat Datang di Website
                </h3> --}}
                <h3 class="text-2xl text-purple-900 font-semibold">
                    Pengajuan Akses Super Komputer DGX A100
                </h3>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 uppercase">
                    Universitas Gunadarma
                </h1>

                <p class="mt-6 text-gray-600 text-base md:text-md">
                    Mesin DGX A100 merupakan mesin dengan 8 (delapan) GPU dan total 320 GB memory, serta memiliki 6 (enam) Nvidia NVSwitches.
                    Mesin Nvidia DGX-1 memiliki kemampuan 56 kali lebih baik daripada CPU, dan 75 kali kecepatan dalam melakukan pelatihan.
                    Mesin Nvidia DGX A100 memiliki kemampuan 172 kali lebih baik daripada CPU server, dan juga kemampuan training, inference, serta data analytic.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('login') }}"
                       class="bg-purple-600 text-white px-6 py-2 rounded font-medium hover:bg-purple-700 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-white text-purple-600 border border-purple-600 px-6 py-2 rounded font-medium hover:bg-purple-100 transition">
                        Daftar
                    </a>
                </div>
            </div>

            <div class="hidden md:flex w-full md:w-1/2 justify-center">
                <img src="{{ asset('images/up01.svg') }}" alt="DGX A100" class="md:w-3/4 h-auto">
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-10 text-center font-urbanist">
    <div class="container mx-auto px-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Mendukung penelitian di setiap tahap
        </h1>
        <h5 class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
            Mulai membangun Kecerdasan Buatan sejak tahap prototyping sampai dengan training dan inference
        </h5>
    </div>
</section>

<section class="bg-gray-50 py-20 font-urbanist">
    <div class="container mx-auto px-12">
        <!-- Judul utama -->
        <h2 class="text-xl md:text-2xl font-bold text-purple-800 mb-5">
            FASILITAS
        </h2>

        <div class="flex flex-col md:flex-row gap-10 items-stretch">
            <!-- Kiri: Deskripsi -->
            <div class="md:w-1/2 pe-8 flex flex-col justify-start">
                <h3 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-6">
                    Memulai Model Pelatihan Segera
                </h3>

                <ul class="space-y-6 text-gray-700 text-base">
                    <li>
                        <strong class="text-xl">Pre-installed Environment</strong><br>
                        Setiap environment telah di install setelah usulan dari pengusul diterima oleh tim approval.
                    </li>
                    <li>
                        <strong class="text-xl">JupyterLab</strong><br>
                        Setiap environment yang diusulkan akan memiliki JupyterLab khusus untuk pengusul dengan resource yang bisa ditentukan sebelumnya.
                    </li>
                    <li>
                        <strong class="text-xl">ClearML</strong><br>
                        Sebuah environment AI Production yang digunakan untuk menjalankan training, model dan hasil program kecerdasan buatan.
                    </li>
                </ul>
            </div>

            <!-- Kanan: Grid gambar -->
            <div class="md:w-1/2 self-stretch">
                <div class="grid grid-cols-2 gap-6 h-full">
                    <div class="px-[20px] flex items-center justify-center h-full bg-[#f9f9f9f9]">
                        <img src="{{ asset('images/stc/jupyter-color-lockup.347bf11e.svg') }}" class="w-[200px] h-auto" alt="Fasilitas 1">
                    </div>
                    <div class="px-[20px] flex items-center justify-center h-full bg-[#f9f9f9f9]">
                        <img src="{{ asset('images/stc/keras-color-lockup.bb8030a8.svg') }}" class="w-[200px] h-auto" alt="Fasilitas 2">
                    </div>
                    <div class="px-[20px] flex items-center justify-center h-full bg-[#f9f9f9f9]">
                        <img src="{{ asset('images/stc/pytorch-color-lockup.d397b868.svg') }}" class="w-[200px] h-auto" alt="Fasilitas 3">
                    </div>
                    <div class="px-[20px] flex items-center justify-center h-full bg-[#f9f9f9f9]">
                        <img src="{{ asset('images/stc/tf-color-lockup.c8db49aa.svg') }}" class="w-[200px] h-auto" alt="Fasilitas 4">
                    </div>
                    <div class="px-[20px] flex items-center justify-center h-full bg-[#f9f9f9f9]">
                        <img src="{{ asset('images/stc/ubuntu-color-lockup.40fe234c.svg') }}" class="w-[200px] h-auto" alt="Fasilitas 5">
                    </div>
                    <div class="px-[20px] flex items-center justify-center h-full bg-[#f9f9f9f9]">
                        <img src="{{ asset('images/stc/ubuntu-color-lockup.40fe234c.svg') }}" class="w-[200px] h-auto" alt="Fasilitas 6">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section class="bg-gray-50 py-20 font-urbanist">
    <div class="container mx-auto px-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Berita Terbaru</h2>
            <p class="text-gray-600 text-base">Informasi terkini seputar layanan superkomputer dan kegiatan riset</p>
        </div>

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($news->take(4) as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300">
                    <a href="{{ route('news.detail', $item->slug) }}">
                        @if ($item['thumbnail'])
                            <img 
                                src="{{ asset('storage/' . $item['thumbnail']) }}" 
                                alt="{{ $item['title'] }}" 
                                class="w-full h-[200px] object-cover" 
                                style="aspect-ratio: 3 / 2;"
                            >
                        @else
                            <div class="w-full h-[200px] bg-gray-200 flex items-center justify-center text-gray-500" style="aspect-ratio: 3 / 2;">
                                No Image
                            </div>
                        @endif
                    </a>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <a href="{{ route('news.detail', $item->slug) }}" class="hover:text-purple-600">
                                {{ $item['title'] }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">
                            {{ \Carbon\Carbon::parse($item['published_at'])->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            {{ Str::limit(strip_tags($item['excerpt']), 100) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ url('/berita') }}" class="inline-block px-6 py-3 bg-purple-600 text-white font-semibold rounded-md hover:bg-purple-700 transition">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>


<section class="bg-purple-50 py-20 font-urbanist">
    <div class="container mx-auto px-6 md:px-12 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Siap Memulai Penelitian Anda?
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
            Ajukan akses superkomputer DGX untuk mendukung penelitian Anda dalam bidang kecerdasan buatan, data science, dan komputasi performa tinggi lainnya.
        </p>
        <a href="{{ url('/registrasi') }}" class="inline-block bg-purple-600 text-white px-8 py-3 text-base font-semibold rounded-md hover:bg-purple-700 transition">
            Ajukan Sekarang
        </a>
    </div>
</section>


@endsection
