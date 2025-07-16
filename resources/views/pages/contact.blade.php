@extends('layouts.app')

@section('title', 'Kontak')

@section('content')

<section class="bg-cover bg-center min-h-80 pt-5 md:pt-20 flex items-center justify-start" style="background-image: url('{{ asset('images/eduvibe-breadcrumb-bg.jpg') }}');">
    <div class="container mx-auto px-12">
        <div class="text-left text-gray-900">
            <h1 class="font-extrabold text-4xl md:text-5xl tracking-tight leading-tight mb-2">Kontak Kami</h1>
            <nav class="text-sm text-gray-700">
                <ol class="list-reset flex space-x-2">
                    <li><a href="/" class="hover:underline text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-800">Kontak</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="bg-white py-10 font-urbanist">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 md:grid-cols-[60%_40%] gap-10 items-start">
            <!-- Kiri: Iframe Maps -->
            <div>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7930.744003719641!2d106.852449!3d-6.34585!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eddffd6fef61%3A0x75ba8521fd0c7d0a!2sGunadarma%20University!5e0!3m2!1sen!2sid!4v1752142472243!5m2!1sen!2sid" 
                    width="100%" 
                    height="350" 
                    class="rounded shadow-md w-full"
                    style="border:0;"
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- Kanan: Info Kontak -->
            <div class="text-left">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Kontak Kami</h2>
                <p class="text-lg text-gray-700 mb-2">{{ $contact->title ?? 'Media Information Center' }}</p>
                <p class="text-gray-700 mb-1">{{ $contact->address ?? 'Jl. Margonda Raya 100, Depok' }}</p>
                <p class="text-gray-700 mb-1">{{ $contact->region ?? 'West Java, INDONESIA – 16424' }}</p>
                <p class="text-gray-700 mb-1">{{ $contact->phone ?? '+62 – 21 – 78881112 ext. 234' }}</p>
                <p class="text-gray-700">
                    Email:
                    <a href="mailto:{{ $contact->email ?? 'mediacenter@gunadarma.ac.id' }}" class="text-purple-600 hover:underline">
                        {{ $contact->email ?? 'mediacenter [@] gunadarma.ac.id' }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>


@endsection