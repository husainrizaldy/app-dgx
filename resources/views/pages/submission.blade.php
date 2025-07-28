@extends('layouts.app')

@section('title', 'Submission')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10">
    <div class="container mx-auto">
    @php
        $tab = request()->query('tab', 'ta');
    @endphp

    <div class="w-11/12 mx-auto mb-4 border-b border-gray-200">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 font-medium text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 font-medium text-sm">
                {{ session('error') }}
            </div>
        @endif
        <nav class="flex gap-4" aria-label="Tabs">
            <a href="{{ route('submission.index', ['tab' => 'ta']) }}"
            class="{{ $tab == 'ta' ? 'border-b-2 border-indigo-500 text-indigo-600' : 'text-gray-600' }} px-3 py-2 text-sm font-medium">Pengajuan TA</a>
            <a href="{{ route('submission.index', ['tab' => 'non-ta']) }}"
            class="{{ $tab == 'non-ta' ? 'border-b-2 border-indigo-500 text-indigo-600' : 'text-gray-600' }} px-3 py-2 text-sm font-medium">Pengajuan NON TA</a>
            <a href="{{ route('submission.index', ['tab' => 'instansi']) }}"
            class="{{ $tab == 'instansi' ? 'border-b-2 border-indigo-500 text-indigo-600' : 'text-gray-600' }} px-3 py-2 text-sm font-medium">Pengajuan Instansi</a>
        </nav>
    </div>

    <div class="w-11/12 mx-auto">
        @if($tab == 'ta')
            @include('pages.tabs.form-ta')
        @elseif($tab == 'non-ta')
            @include('pages.tabs.form-non-ta')
        @elseif($tab == 'instansi')
            @include('pages.tabs.form-instansi')
        @endif
    </div>
    </div>
</section>

@endsection