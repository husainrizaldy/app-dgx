@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10">
    <div class="container px-12 py-6">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8 border border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Login</h2>
            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 font-medium text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-1 gap-6">
                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                        Masuk
                    </button>
                </div>
                <div class="pt-4 text-center text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ url('registrasi') }}" class="text-purple-600 hover:underline font-medium">
                        Daftar di sini
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection