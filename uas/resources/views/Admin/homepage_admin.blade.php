@extends('layouts.admin')

@section('content')
@vite('resources/css/app.css')

<body class="bg-gray-800 text-white">
    <div class="p-6">
        <section class="text-justify">
            <h2 class="text-2xl font-bold mb-2">Welcome To HMIF Space</h2>
            <p>Sebuah website untuk Himpunan Mahasiswa Informatika (HMIF) yang menyediakan ruang digital bagi anggotanya
                untuk berkolaborasi, mengelola tugas, dan berkomunikasi. Nama ini menunjukkan bahwa website tersebut
                merupakan dapat memenuhi kebutuhan anggota HMIF dalam menjalankan kegiatan, mengatur peran, dan
                mengelola tugas-tugas divisi dengan lebih efisien.</p>
                <br />
            <p>Dengan HMIF Space, anggota HMIF memiliki akses ke informasi penting seperti daftar tugas divisi,
                timeline acara, dan grup chat, yang semuanya bisa dikelola dalam satu websitel yang dapat diakses kapan
                saja.</p>
        </section>

        <section class="mt-6 p-4 bg-white text-black rounded">
            <h2 class="text-3xl font-bold text-center mb-2">HMIF</h2>
            <p class="text-justify">Himpunan Mahasiswa Informatika UMN hadir sebagai wadah untuk mahasiswa informatika UMN belajar dan
                berkarya bersama demi kemajuan teknologi dan masyarakat. HMIF memiliki visi untuk mengembangkan potensi
                dan memperkuat solidaritas sesama mahasiswa informatika UMN.
                Pada tahun 2024, HMIF telah mencapai anggota generasi ke-15 yang mencakup BPH dan 4 Divisi lainnya
                dengan total anggota sebanyak 36 orang.</p>
            <div class="flex justify-center mt-4">
                <a href="{{ route('hmifpage') }}"
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400">Show</a>
            </div>
        </section>

        <section class="mt-6 text-center">
            <h3 class="text-xl font-semibold mb-4">Program Kerja HMIF</h3>
            <div class="flex flex-wrap justify-center gap-16">
                <div
                    class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="{{ asset('img/Infinite.png') }}" alt="Profile Picture 1"
                        class="w-full h-full object-cover cursor-pointer" data-modal-target="modal-1">
                </div>
                <div
                    class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="{{ asset('img/PPIF.png') }}" alt="Profile Picture 2"
                        class="w-full h-full object-cover cursor-pointer" data-modal-target="modal-2">
                </div>
                <div
                    class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="{{ asset('img/CodeXpo.png') }}" alt="Profile Picture 3"
                        class="w-full h-full object-cover cursor-pointer" data-modal-target="modal-3">
                </div>
                <div
                    class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="{{ asset('img/Comvis.png') }}" alt="Profile Picture 4"
                        class="w-full h-full object-cover cursor-pointer" data-modal-target="modal-4">
                </div>
                <div
                    class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="{{ asset('img/Sport.png') }}" alt="Profile Picture 5"
                        class="w-full h-full object-cover cursor-pointer" data-modal-target="modal-5">
                </div>
                <div
                    class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden relative">
                    <img src="{{ asset('img/UTF.png') }}" alt="Profile Picture 6"
                        class="w-full h-full object-cover cursor-pointer" data-modal-target="modal-6">
                </div>
            </div>

            <div id="modal-1"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white text-black rounded-lg p-6 w-96">
                    <h3 class="text-xl font-semibold mb-4">Infinite</h3>
                    <p>Infinite adalah acara gathering yang mempertemukan mahasiswa, dosen, dan alumni Informatika UMN dalam suasana penuh kebersamaan, khususnya untuk menyambut mahasiswa baru melalui kegiatan seru dan interaktif sebagai puncak dari rangkaian PPIF (Perkenalan Prodi Informatika)</p>
                    <div class="flex justify-center mt-4">
                        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400"
                            onclick="closeModal('modal-1')">Close</button>
                    </div>
                </div>
            </div>

            <div id="modal-2"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white text-black rounded-lg p-6 w-96">
                    <h3 class="text-xl font-semibold mb-4">PPIF</h3>
                    <p>PPIF (Perkenalan Prodi Informatika) adalah kesempatan bagi mahasiswa untuk melakukan networking dan mengembangkan kemampuan berkomunikasi dengan mengenal lebih dalam program studi yang telah mereka pilih yaitu Informatika.</p>
                    <div class="flex justify-center mt-4">
                        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400"
                            onclick="closeModal('modal-2')">Close</button>
                    </div>
                </div>
            </div>
            <div id="modal-3"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white text-black rounded-lg p-6 w-96">
                    <h3 class="text-xl font-semibold mb-4">CodeXpo</h3>
                    <p>CodeXpo adalah kegiatan wajib bagi mahasiswa Informatika pada mata kuliah Pengantar Teknologi Internet, dimana para mahasiswa diwajibkan untuk melakukan pameran hasil website mereka.</p>
                    <div class="flex justify-center mt-4">
                        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400"
                            onclick="closeModal('modal-3')">Close</button>
                    </div>
                </div>
            </div>

            <div id="modal-4"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white text-black rounded-lg p-6 w-96">
                    <h3 class="text-xl font-semibold mb-4">Code Connect</h3>
                    <p>Code Connect adalah sebuah acara dimana para mahasiswa Informatika mendapatkan kesempatan untuk mengikuti "Office Tour" pada perusahaan-perusahaan IT ternama di Indonesia.</p>
                    <div class="flex justify-center mt-4">
                        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400"
                            onclick="closeModal('modal-4')">Close</button>
                    </div>
                </div>
            </div>

            <div id="modal-5"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white text-black rounded-lg p-6 w-96">
                    <h3 class="text-xl font-semibold mb-4">CSS</h3>
                    <p>CSS (Computer Science Shelter) adalah program fun-gathering yang bertujuan untuk mengembangkan soft skill dan hard skill mahasiswa Informatika di bidang teknologi informasi serta meningkatkan solidaritas dan kekeluargaan sesama mahasiswa Informatika.</p>
                    <div class="flex justify-center mt-4">
                        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400"
                            onclick="closeModal('modal-5')">Close</button>
                    </div>
                </div>
            </div>

            <div id="modal-6"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white text-black rounded-lg p-6 w-96">
                    <h3 class="text-xl font-semibold mb-4">UTF</h3>
                    <p>UTF (UMN Tech Festival) adalah ajang untuk menampilkan inovasi teknologi terbaru yang dibuat oleh mahasiswa Fakultas Teknik & Informatika serta belajar dan juga menambah ilmu dari sesama mahasiswa.</p>
                    <div class="flex justify-center mt-4">
                        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400"
                            onclick="closeModal('modal-6')">Close</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        document.querySelectorAll('[data-modal-target]').forEach(item => {
            item.addEventListener('click', () => {
                const modalId = item.getAttribute('data-modal-target');
                document.getElementById(modalId).classList.remove('hidden');
            });
        });
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</body>
@endsection