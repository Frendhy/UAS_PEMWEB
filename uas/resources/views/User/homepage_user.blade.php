@extends('layouts.user')

@section('content')
@vite('resources/css/app.css')

<body class="bg-gray-800 text-white">
    <div class="p-6">
        <section>
            <h2 class="text-2xl font-bold mb-2">Welcome To HMIF Space</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua...</p>
        </section>

        <section class="mt-6 p-4 bg-white text-black rounded">
            <h2 class="text-3xl font-bold text-center mb-2">HMIF</h2>
            <p class=>Himpunan Mahasiswa Informatika UMN hadir sebagai wadah untuk mahasiswa informatika UMN belajar dan
                berkarya bersama demi kemajuan teknologi dan masyarakat. HMIF memiliki visi untuk mengembangkan potensi
                dan memperkuat solidaritas sesama mahasiswa informatika UMN.
                Pada tahun 2024, HMIF telah mencapai anggota generasi ke-15 yang mencakup BPH dan 4 Divisi lainnya
                dengan total anggota sebanyak 36 orang.</p>
            <div class="flex justify-center mt-4">
                <a href="{{route('hmifpage')}}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400">Show</a>
            </div>
        </section>

        <section class="mt-6 text-center">
            <h3 class="text-xl font-semibold mb-4">Proker</h3>
            <div class="flex flex-wrap justify-center gap-16">
                <div class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="https://via.placeholder.com/80" alt="Profile Picture {{1}}" class=" w-full h-full object-cover">
                </div>
                <div class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="https://via.placeholder.com/80" alt="Profile Picture {{2}}" class=" w-full h-full object-cover">
                </div>
                <div class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="https://via.placeholder.com/80" alt="Profile Picture {{3}}" class=" w-full h-full object-cover">
                </div>
                <div class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="https://via.placeholder.com/80" alt="Profile Picture {{4}}" class=" w-full h-full object-cover">
                </div>
                <div class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="https://via.placeholder.com/80" alt="Profile Picture {{5}}" class=" w-full h-full object-cover">
                </div>
                <div class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="https://via.placeholder.com/80" alt="Profile Picture {{6}}" class=" w-full h-full object-cover">
                </div>
            </div>
        </section>
    </div>
</body>
@endsection