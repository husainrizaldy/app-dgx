<footer class="bg-[#231f40] shadow mt-10 pt-10">
    <div class="container mx-auto px-6 lg:px-20 flex flex-col lg:flex-row gap-8 mb-20">
        
        <div class="w-fit hidden md:block">
            <img src="{{ asset('images/logoug-1-2.png') }}" alt="Gunadarma Logo" class="h-auto w-24">
            <p class="text-white">Universitas Gunadarma</p>
        </div>

        <div class="flex flex-wrap lg:flex-row flex-col gap-8 w-full lg:justify-evenly text-white">
            
            <div>
                <h3 class="text-2xl font-semibold mb-6">HUBUNGI KAMI</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>Jl. Margonda Raya 100, Depok, <br> West Java, INDONESIA - 16424</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <div>
                            <a href="mailto:mediacenter@gunadarma.ac.id" class="hover:underline">mediacenter@gunadarma.ac.id</a>
                            <br>
                            <a href="mailto:infodgx@gunadarma.ac.id" class="hover:underline">infodgx@gunadarma.ac.id</a>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <a href="tel:+6282178881112" class="hover:underline">+62-21-78881112 ext.234</a>
                    </li>
                </ul>

                <div class="flex items-center gap-4 mt-6">
                    <a href="https://instagram.com/" class="hover:opacity-80">
                        <img src="{{ asset('images/social/instagram.svg') }}" alt="instagram Logo" class="h-10">
                    </a>
                    <a href="https://www.linkedin.com/" class="hover:opacity-80">
                        <img src="{{ asset('images/social/linkedin.svg') }}" alt="linkedin Logo" class="h-10">
                    </a>

                </div>
            </div>

            <div class="flex flex-row md:grid md:grid-cols-2 gap-8">

                <div>
                    <h3 class="text-2xl font-semibold mb-6">SERVICE</h3>
                    <ul class="space-y-2">
                        <li><a href="/registrasi" class="hover:underline">Registrasi</a></li>
                        <li><a href="/berita" class="hover:underline">Berita</a></li>
                        <li><a href="/panduan" class="hover:underline">Panduan</a></li>
                    </ul>
                </div>
    
                <div>
                    <h3 class="text-2xl font-semibold mb-6">LEGAL</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:underline">Syarat dan Ketentuan</a></li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

    <div class="container mx-auto px-4 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Dgx. All rights reserved.
    </div>

</footer>
