@extends('layouts.app')

@section('title', 'Panduan')

@section('content')
<section class="bg-cover bg-center min-h-80 pt-5 md:pt-20 flex items-center justify-start" style="background-image: url('{{ asset('images/eduvibe-breadcrumb-bg.jpg') }}');">
    <div class="container mx-auto px-12">
        <div class="text-left text-gray-900">
            <h1 class="font-extrabold text-4xl md:text-5xl tracking-tight leading-tight mb-2">Panduan</h1>
            <nav class="text-sm text-gray-700">
                <ol class="list-reset flex space-x-2">
                    <li><a href="/" class="hover:underline text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-800">Panduan</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="bg-white py-10 font-urbanist">
    <div class="container mx-auto px-6 md:px-12 space-y-10">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $guide?->title }}</h2>
            {!! $guide?->body !!}
        </div>
    </div>
</section>

@endsection