@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
<section class="bg-gray-100 min-h-[calc(100vh-4rem)] pt-28 pb-10">
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8 border border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Registrasi</h2>
            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" oninput="repass.setCustomValidity(repass.value !== password.value ? 'Password tidak sama' : '')">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" autocomplete="given-name" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" autocomplete="email" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="new-password" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                    <div>
                        <label for="repass" class="block text-sm/6 font-medium text-gray-900">
                            Ulangi Password <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="password" name="repass" id="repass" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="agency" class="block text-sm/6 font-medium text-gray-900">Instansi</label>
                        <div class="mt-2">
                            <input type="text" name="agency" id="agency" autocomplete="organization"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                        Daftar
                    </button>
                </div>

                <div class="pt-4 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ url('login') }}" class="text-purple-600 hover:underline font-medium">Login di sini</a>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection