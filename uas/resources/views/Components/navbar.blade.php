<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <nav class="bg-gray-800 shadow">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('hmifpage') }}">
                        <img src="{{ asset('img/Logo-HMIF.png') }}" alt="logo" class="w-10 h-10">
                    </a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="menu-toggle" class="text-gray-300 focus:outline-none focus:text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <div id="menu" class="hidden md:flex md:space-x-4">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}"
                            class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center">
                    <a href="{{ route('profile.edit') }}">
                        <div
                            class="w-10 h-10 flex items-center justify-center text-xl text-white bg-gray-700 rounded-full cursor-pointer">
                            🏠
                        </div>
                    </a>
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden">
                <div class="space-y-1 px-2 pt-2 pb-3">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}"
                            class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>