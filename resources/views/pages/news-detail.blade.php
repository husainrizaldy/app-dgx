@extends('layouts.app')

@section('title', $news->title)

@section('content')
<section class="bg-cover bg-center min-h-80 pt-5 md:pt-20 flex items-center justify-start" style="background-image: url('{{ asset('images/eduvibe-breadcrumb-bg.jpg') }}');">
    <div class="container mx-auto px-12">
        <div class="text-left text-gray-900">
            <h1 class="font-extrabold text-4xl md:text-5xl tracking-tight leading-tight mb-2">{{ $news->title }}</h1>
            <nav class="text-sm text-gray-700">
                <ol class="list-reset flex space-x-2">
                    <li><a href="/" class="hover:underline text-gray-700">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ url('/berita') }}" class="hover:underline text-gray-700">Berita</a></li>
                    <li>/</li>
                    <li class="text-gray-800">{{ $news->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="bg-white py-10 font-urbanist">
    <div class="container mx-auto px-6 md:px-12 max-w-4xl">
        @if ($news->thumbnail)
            <img 
                src="{{ asset('storage/' . $news->thumbnail) }}" 
                alt="{{ $news->title }}" 
                class="w-full h-auto rounded-lg mb-6 shadow"
            >
        @endif

        <p class="text-sm text-gray-500 mb-4">
            Dipublikasikan pada {{ $news->published_at->translatedFormat('d F Y') }}
        </p>

        <div class="prose max-w-none">
            {!! $news->content !!}
        </div>
    </div>
</section>
@endsection
