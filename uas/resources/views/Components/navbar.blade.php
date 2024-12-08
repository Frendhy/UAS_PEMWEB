<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <nav class="bg-gray-800 shadow">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="logo"class="w-10 h-10">
                </div>
                <div class="hidden md:flex space-x-4">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}"
                            class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="logo"class="w-10 h-10">
                </div>
            </div>
        </div>
    </nav>
</body>

</html>