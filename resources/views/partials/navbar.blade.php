<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white shadow fixed top-0 left-0 w-full z-50 font-urbanist">
    <div class="container mx-auto px-12 py-3 flex items-center justify-between">
        {{-- Logo --}}
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logoug-1-2.png') }}" alt="Logo UG" class="h-16">
        </a>

        {{-- Toggle Button (Mobile) --}}
        <button @click="open = !open" class="md:hidden text-gray-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Menu Items (Desktop) --}}
        <div class="hidden md:flex md:items-center md:space-x-2">
            @php $current = request()->path(); @endphp

            {{-- Public menu --}}
            <a href="{{ url('/') }}" class="px-4 py-2 rounded-full text-md font-semibold transition font-urbanist {{ $current === '/' ? 'bg-purple-600 text-white' : 'text-gray-600 hover:bg-purple-600 hover:text-white' }}">Beranda</a>
            <a href="{{ url('/berita') }}" class="px-4 py-2 rounded-full text-md font-semibold transition font-urbanist {{ $current === 'berita' ? 'bg-purple-600 text-white' : 'text-gray-600 hover:bg-purple-600 hover:text-white' }}">Berita</a>
            <a href="{{ url('/panduan') }}" class="px-4 py-2 rounded-full text-md font-semibold transition font-urbanist {{ $current === 'panduan' ? 'bg-purple-600 text-white' : 'text-gray-600 hover:bg-purple-600 hover:text-white' }}">Panduan</a>
            <a href="{{ url('/kontak') }}" class="px-4 py-2 rounded-full text-md font-semibold transition font-urbanist {{ $current === 'kontak' ? 'bg-purple-600 text-white' : 'text-gray-600 hover:bg-purple-600 hover:text-white' }}">Kontak</a>

            {{-- Conditional Login/Register or Member Dropdown --}}
            @if(auth('member')->check())
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="px-4 py-2 rounded-full text-md font-semibold transition font-urbanist flex items-center text-gray-600 hover:bg-purple-600 hover:text-white">
                        {{ auth('member')->user()->name }}
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.354a.75.75 0 011.14.976l-4 4.7a.75.75 0 01-1.14 0l-4-4.7a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-md z-50">
                        <a href="{{ route('submission.status') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">Daftar Pengajuan</a>
                        <a href="{{ route('submission.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">Pengajuan Baru</a>
                        <a href="{{ route('machine.list') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">Daftar Mesin</a>
                        <a href="{{ route('procedure.list') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">Prosedur</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-full text-md font-semibold transition font-urbanist {{ $current === 'registrasi' ? 'bg-purple-600 text-white' : 'text-gray-600 hover:bg-purple-600 hover:text-white' }}">Registrasi</a>
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-md font-semibold transition font-urbanist {{ $current === 'login' ? 'bg-purple-600 text-white' : 'text-gray-600 hover:bg-purple-600 hover:text-white' }}">Login</a>
            @endif
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-cloak x-show="open" x-collapse class="md:hidden px-4 pb-4">
        <div class="flex flex-col space-y-2">
            <a href="{{ url('/') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Beranda</a>
            <a href="{{ url('/berita') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Berita</a>
            <a href="{{ url('/panduan') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Panduan</a>
            <a href="{{ url('/kontak') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Kontak</a>

            @if(auth('member')->check())
                <a href="{{ route('submission.status') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Daftar Pengajuan</a>
                <a href="{{ route('submission.index') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Pengajuan Baru</a>
                <a href="{{ route('machine.list') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Daftar Mesin</a>
                <a href="{{ route('procedure.list') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Prosedur</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-center w-full px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Logout</button>
                </form>
            @else
                <a href="{{ route('register') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Registrasi</a>
                <a href="{{ route('login') }}" class="text-center px-4 py-2 rounded-full text-sm font-semibold transition font-urbanist text-gray-600 hover:bg-purple-600 hover:text-white">Login</a>
            @endif
        </div>
    </div>
</nav>
