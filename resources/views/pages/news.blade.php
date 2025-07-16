@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<section class="bg-cover bg-center min-h-80 pt-5 md:pt-20 flex items-center justify-start" style="background-image: url('{{ asset('images/eduvibe-breadcrumb-bg.jpg') }}');">
    <div class="container mx-auto px-12">
        <div class="text-left text-gray-900">
            <h1 class="font-extrabold text-4xl md:text-5xl tracking-tight leading-tight mb-2">Berita</h1>
            <nav class="text-sm text-gray-700">
                <ol class="list-reset flex space-x-2">
                    <li><a href="/" class="hover:underline text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-800">Berita</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="bg-white py-10 font-urbanist">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($news as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300">
                    <a href="{{ route('news.detail', $item->slug) }}">
                        @if ($item['thumbnail'])
                            <img 
                                src="{{ asset('storage/' . $item['thumbnail']) }}" 
                                alt="{{ $item['title'] }}" 
                                class="w-full h-[250px] object-cover" 
                                style="aspect-ratio: 3 / 2;"
                            >
                        @else
                            <div class="w-full h-[250px] bg-gray-200 flex items-center justify-center text-gray-500" style="aspect-ratio: 3 / 2;">
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
                        <div class="mt-4">
                            <a href="{{ route('news.detail', $item->slug) }}" class="text-purple-600 font-medium hover:underline text-sm">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
