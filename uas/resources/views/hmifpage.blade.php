<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMIF Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 text-white">
    @if(auth()->user()->role_id == 1)
        <x-navbar :title="'Admin Panel'" :links="[
                ['label' => 'Home', 'url' => route('admin.home')],
                ['label' => 'To Do List', 'url' => route('admin.todo')],
                ['label' => 'Message', 'url' => route('admin.message')],
                ['label' => 'Calendar', 'url' => route('admin.calendar')],
                ['label' => 'Logout', 'url' => '#', 'onclick' => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();']
            ]" />
    @elseif(auth()->user()->role_id == 2)
        <x-navbar :title="'User Panel'" :links="[
                ['label' => 'Home', 'url' => route('user.home')],
                ['label' => 'Tasks', 'url' => route('user.todo')],
                ['label' => 'Messages', 'url' => route('user.message')],
                ['label' => 'Calendar', 'url' => route('user.calendar')],
                ['label' => 'Logout', 'url' => '#', 'onclick' => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();']
            ]" />
    @endif
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <div class="flex flex-col md:flex-row items-center justify-center my-12 space-y-6 md:space-y-0 md:space-x-12">
        <img src="{{ asset('img/Logo-HMIF.png') }}" alt="Profile Image" class="w-48 h-48 flex-shrink-0 object-cover">
        <div class="text-center md:text-left px-4 md:px-12">
            <h1 class="text-3xl font-bold mb-4">HMIF</h1>
            <p class="max-w-md text-gray-300 text-justify md:text-left">
                Himpunan Mahasiswa Informatika UMN hadir sebagai wadah untuk mahasiswa informatika UMN belajar dan
                berkarya bersama demi kemajuan teknologi dan masyarakat. HMIF memiliki visi untuk mengembangkan potensi
                dan memperkuat solidaritas sesama mahasiswa informatika UMN.
                Pada tahun 2024, HMIF telah mencapai anggota generasi ke-15 yang mencakup BPH dan 4 Divisi lainnya
                dengan total anggota sebanyak 36 orang.
            </p>
        </div>
    </div>


    <div id="bph" class="text-center my-12">
        <h2 class="text-3xl font-semibold mb-6">BPH</h2>
        <div class="flex flex-wrap justify-center gap-6 ">
            <img src="{{ asset('img/bph1.jpeg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-40 h-40 cursor-pointer"
                data-member="Alfonsus Vega HT Wijaya"
                data-description="Ketua HMIF Gen XV - Ikan kalo berenang jadi catfish"
                data-image="{{ asset('img/bph1.jpeg') }}">
            <img src="{{ asset('img/bph2.jpeg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-40 h-40 cursor-pointer"
                data-member="Audrey Christabelle Hakim" data-description="Wakil ketua HMIF Gen XV - ya gtu.. "
                data-image="{{ asset('img/bph2.jpeg') }}">
            <img src="{{ asset('img/bph3.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-40 h-40 cursor-pointer"
                data-member="Henry Salim"
                data-description="Sekretaris HMIF Gen XV - Today's labor bears tomorrow's fruits"
                data-image="{{ asset('img/bph3.jpg') }}">
            <img src="{{ asset('img/bph4.jpeg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-40 h-40 cursor-pointer"
                data-description="Bendahara HMIF Gen XV - Many are able, but few are available"
                data-image="{{ asset('img/bph4.jpeg') }}">
        </div>
    </div>

    <div id="divisi" class="text-center my-12">
        <h2 class="text-3xl font-semibold mb-6">Project Manager</h2>
        <div class="flex flex-wrap justify-center gap-6">
            <img src="{{ asset('img/pm1.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Nathanael Axl Jaconiah"
                data-description="Koordinator Project Manager - stop makan kol goreng"
                data-image="{{ asset('img/pm1.jpg') }}">
            <img src="{{ asset('img/pm2.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Wilbert Budi Lian"
                data-description="Wakil Koordinator Project Manager - bilas muka, gosok gigi, evaluasi"
                data-image="{{ asset('img/pm2.jpg') }}">
            <img src="{{ asset('img/pm3.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Gracia Nathania" data-description="Face it until you ace it"
                data-image="{{ asset('img/pm3.jpg') }}">
            <img src="{{ asset('img/pm4.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Jessy Valentine " data-description="a²+b²=c² yey" data-image="{{ asset('img/pm4.jpg') }}">
            <img src="{{ asset('img/pm5.jpeg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Febyanti Eirene" data-description="Dear music, thanks."
                data-image="{{ asset('img/pm5.jpeg') }}">
            <img src="{{ asset('img/pm6.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Dominikus Dylon" data-description="(-) diisinya ini ges.."
                data-image="{{ asset('img/pm6.jpg') }}">
            <img src="{{ asset('img/pm7.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Andika syahfutra" data-description="be a good person with smiles and laughter"
                data-image="{{ asset('img/pm7.jpg') }}">
            <img src="{{ asset('img/pm8.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Cindy Permatasari Khoeniawan" data-description="Deskripsi profil PM 8"
                data-image="{{ asset('img/pm8.jpg') }}">
        </div>
    </div>

    <div id="divisi" class="text-center my-12">
        <h2 class="text-3xl font-semibold mb-6">Research & Development</h2>
        <div class="flex flex-wrap justify-center gap-6">
            <img src="{{ asset('img/rnd1.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Felicia Sabatini Gunawan"
                data-description="Koordinator Research & Development - Jgn lupa semicolon ;) "
                data-image="{{ asset('img/rnd1.jpg') }}">
            <img src="{{ asset('img/rnd2.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Ardifa Rizky Saputra"
                data-description="Wakil Koordinator Research & Development - Cita-citaku adalah menjadi seorang chef"
                data-image="{{ asset('img/rnd2.jpg') }}">
            <img src="{{ asset('img/rnd3.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Aditya Zianur Rahman Setiadi " data-description="A wolf does not fear a barking dog"
                data-image="{{ asset('img/rnd3.jpg') }}">
            <img src="{{ asset('img/rnd4.jpeg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Jimmy Wijaya Tandra" data-description="Manusia setengah AI"
                data-image="{{ asset('img/rnd4.jpg') }}">
            <img src="{{ asset('img/rnd5.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Rafael Natanael"
                data-description="A decision made out of fear is always the wrong decision, but good decisions are made from a strong heart."
                data-image="{{ asset('img/rnd5.jpg') }}">
            <img src="{{ asset('img/rnd6.png') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Steven Jonathan" data-description="wa eng cai an cua wa e ki cepeng"
                data-image="{{ asset('img/rnd6.png') }}">
            <img src="{{ asset('img/rnd7.jpeg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Devin Wongosari" data-description="Aku berlutut? Tidak akan..... Jarang"
                data-image="{{ asset('img/rnd7.jpeg') }}">
            <img src="{{ asset('img/rnd8.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Jordan Arya Yohamsa" data-description="GPT, Jadilah Saya"
                data-image="{{ asset('img/rnd8.jpg') }}">
        </div>
    </div>

    <div id="divisi" class="text-center my-12">
        <h2 class="text-3xl font-semibold mb-6">Public Relation</h2>
        <div class="flex flex-wrap justify-center gap-6">
            <img src="{{ asset('img/pr1.jpeg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Sharon Tionardi" data-description="Koordinator Public Relation - 你爱我吗？"
                data-image="{{ asset('img/pr1.jpeg') }}">
            <img src="{{ asset('img/pr2.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Vanessa Audrelia Christianto"
                data-description="Wakil Koordinator Public Relation - Deskripsi profil PR 2"
                data-image="{{ asset('img/pr2.jpg') }}">
            <img src="{{ asset('img/pr3.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Jesselyn Vania Angelie"
                data-description="don't forget to touch the grass🌱 i'm open for any opportunity to learn"
                data-image="{{ asset('img/pr3.jpg') }}">
            <img src="{{ asset('img/pr4.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Vieny Evelyn" data-description="Selama ada keinginan, semuanya pasti bisa"
                data-image="{{ asset('img/pr4.jpg') }}">
            <img src="{{ asset('img/pr5.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Gerald Alfons Nathaniel Werdiyanto"
                data-description="tidur lanjutkan mimpi, bangun wujudkan mimpi" data-image="{{ asset('img/pr5.jpg') }}">
            <img src="{{ asset('img/pr6.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="William Asabha Purnamadjaja" data-description="Deskripsi profil PR 6"
                data-image="{{ asset('img/pr6.jpg') }}">
            <img src="{{ asset('img/pr7.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Rafael Romelo Gibran" data-description="itu ambil nasi pak vinsen "
                data-image="{{ asset('img/pr7.jpg') }}">
            <img src="{{ asset('img/pr8.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Clerensia Catherine" data-description="Deskripsi profil PR 8"
                data-image="{{ asset('img/pr8.jpg') }}">
        </div>
    </div>

    <div id="divisi" class="text-center my-12">
        <h2 class="text-3xl font-semibold mb-6">Creative & Design</h2>
        <div class="flex flex-wrap justify-center gap-6">
            <img src="{{ asset('img/cr1.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Frendhy Zhuang" data-description="Koordinator Creative & Design- 我真的很爱你"
                data-image="{{ asset('img/cr1.jpg') }}">
            <img src="{{ asset('img/cr2.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Maulidya Isnaini "
                data-description="Koordinator Creative & Design - m a u l i d Y A, panggil Maul aja. Thanks"
                data-image="{{ asset('img/cr2.jpg') }}">
            <img src="{{ asset('img/cr3.png') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Gregorius Jordan Irawan"
                data-description="Koordinator Creative & Design- The world is your oyster. Open it up and discover its pearls. - N. H. Kleinbaum, Dead Poets Society"
                data-image="{{ asset('img/cr3.png') }}">
            <img src="{{ asset('img/cr4.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Qonita Azalia"
                data-description="Koordinator Creative & Design - hari hari pacaran sama figma "
                data-image="{{ asset('img/cr4.jpg') }}">
            <img src="{{ asset('img/cr5.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Muhammad Faathin Naufal" data-description="Inna Ma’al ‘Usri Yusrā"
                data-image="{{ asset('img/cr5.jpg') }}">
            <img src="{{ asset('img/cr6.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Aisya Adiyan" data-description="gapapa belom punya rumah, yang penting punya keychain"
                data-image="{{ asset('img/cr6.jpg') }}">
            <img src="{{ asset('img/cr7.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Howard" data-description="Experience speaks louder than knowledge."
                data-image="{{ asset('img/cr7.jpg') }}">
            <img src="{{ asset('img/cr8.jpg') }}" alt="Profile Image"
                class="object-cover circle bg-gray-500 hover:opacity-60 rounded-full w-32 h-32 cursor-pointer"
                data-member="Angela Benedictin Sunny" data-description="Deskripsi profil CR 8"
                data-image="{{ asset('img/cr8.jpg') }}">
        </div>
    </div>

    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center">
        <div class="bg-white text-black rounded-lg p-6 max-w-md text-center">
            <img id="member-image" class="w-32 h-32 rounded-full mx-auto mb-4" src="" alt="Profile Image">
            <h3 id="member-name" class="text-xl font-bold mb-4"></h3>
            <p id="member-description" class="text-gray-700">Profil member akan ditampilkan di sini.</p>
            <button id="close-modal"
                class="mt-6 px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-500">Close</button>
        </div>
    </div>

    <script>
        document.querySelector('[href="#"]').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
        const modal = document.getElementById('modal');
        const memberName = document.getElementById('member-name');
        const memberDescription = document.getElementById('member-description');
        const memberImage = document.getElementById('member-image');
        const closeModal = document.getElementById('close-modal');
        const circles = document.querySelectorAll('.circle');

        circles.forEach(circle => {
            circle.addEventListener('click', () => {
                const member = circle.getAttribute('data-member');
                const description = circle.getAttribute('data-description');
                const imageUrl = circle.getAttribute('data-image');
                memberName.textContent = member;
                memberDescription.textContent = description;
                memberImage.src = imageUrl;
                modal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>