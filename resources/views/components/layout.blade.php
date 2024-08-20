<!doctype html>

<title>Invoice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<style>
    html {
        scroll-behavior: smooth;
    }
    .clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp.ome-line {
        -webkit-line-clamp: 1;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-4 bg-zinc-200">
    <nav class="flex justify-between items-center ">
        @auth
            <a href="/" class="text-lg font-bold ">Invoice</a>

            <div class=" flex items-center gap-3">
                <a href="{{ route('company.create') }}" class="text-sm font-bold uppercase">New Company</a>
                <x-dropdown2>
                    <x-slot name="trigger">
                        <button class="bg-black rounded-md text-sm font-semibold text-white uppercase
                        py-2 px-3">Welcome, {{ auth()->user()->first_name }}</button>
                    </x-slot>

                    <x-dropdown-item href="{{ route('profile.edit') }}">
                        Profile
                    </x-dropdown-item>
                    <x-dropdown-item>
                        <form action="{{ route('logout') }}" method="Post">
                            @csrf
                            <button type="submit" class="w-full text-left">Logout</button>
                        </form>
                    </x-dropdown-item>
                </x-dropdown2>
            </div>
        @else
            <a href="" class="text-xs font-bold uppercase">
                Help Center
            </a>

            <a href="/" class="text-lg font-bold ">Invoice</a>

            <div class=" flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-xs font-bold uppercase">Login</a>

                <a href="{{ route('register') }}" class="bg-black rounded-md text-xs font-semibold text-white uppercase
                    py-2 px-3">
                    Get Started
                </a>
            </div>
        @endauth
    </nav>

    {{ $slot }}

    <footer id="newsletter" class=" bottom-4 left-6 right-6 bg-blue-900  rounded-xl text-center p-8
    mt-5">
        <div class="flex flex-col md:flex-row md:justify-between">
            <div class="flex flex-col md:flex-row gap-14 text-left">
                <div class="flex flex-col gap-1">
                    <h4 class="text-md font-md text-gray-500">Personal</h4>
                    <a href="" class="text-sm text-gray-200">New Company</a>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="text-md font-md text-gray-500">Info</h4>
                    <a href="" class="text-sm text-gray-200">+233 204868516</a>
                    <a href="" class="text-sm text-gray-200">hello@invoice.com</a>
                </div>
            </div>

            <div class="flex flex-col gap-1 text-right">
                @auth
                    <h4 class="text-md font-md text-gray-500">Address</h4>
                @else
                    <a href="" class="bg-blue-400 rounded-md text-xs text-center font-semibold text-white uppercase py-2
                     px-3">
                        Get Started
                    </a>
                @endauth
                <a href="" class="text-sm text-gray-200">23rd Accra Rd. Accra</a>
                <h4 class="text-sm text-gray-200">Greater Accra, Ghana</h4>
            </div>


        </div>
        <div class="flex md:flex-row flex-col justify-between">
            <h3 class="text-sm text-gray-500">2024 - Copyright</h3>
            <a href="" class="text-sm text-gray-500">Privacy</a>
        </div>
    </footer>
</section>


</body>
