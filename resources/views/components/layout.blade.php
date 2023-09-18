<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="icon" href="images/favicon.ico" /> --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <title>ItemSwap | Exchange your items</title>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>

</head>
<body class="mb-48 bg-neutral-800">
    <nav class="flex w-full justify-between items-center mb-4 p-4 bg-neutral-900">
        <a href="/" class="ml-10 text-2xl text-gray-400 hover:text-white">
            ItemSwap
            {{-- <img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"/> --}}
        </a>
        <ul class="flex space-x-10 mr-8 text-sm font-semibold">
            @auth
            <li>
                <a href="{{route('edit-profile')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-user"></i> Edit profile</a>
            </li>
            <li>
                <a href="{{route('messages', ['conversation'=>null])}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-message"></i>
                    Messages</a
                >
            </li>
            <li>
                <a href="/" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-right-left"></i>
                    Swaps</a
                >
            </li>
            <li>
                <a href="{{route('manage-listings')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-gear"></i>
                    Manage Listings</a
                >
            </li>
            <li>
                <form class="inline" action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white">
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                </form>
            </li>
            @else
            <li>
                <a href="{{route('register')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-user-plus"></i> Register</a
                >
            </li>
            <li>
                <a href="{{route('login')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a
                >
            </li>
            @endauth
        </ul>
    </nav>
    <main class="justify-items-center">
        @yield('content')
    </main>
    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-neutral-900 text-gray-400 h-24 mt-18 opacity-90 md:justify-center"
    >
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>

        <a
            href="{{route('create-listing-form')}}"
            class="absolute top-1/3 right-10 bg-black text-gray-200 py-2 px-5 rounded-lg hover:text-laravel"
            >Post Listing</a
        >
    </footer>
    <x-flash-message/>

</body>
</html>