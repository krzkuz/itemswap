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
        <a href="/" class="sm:ml-10 text-2xl text-gray-400 hover:text-white">
            ItemSwap
            {{-- <img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"/> --}}
        </a>
        <ul class="flex space-x-2 sm:space-x-10 mr-8 text-sm font-semibold">
            @auth
            <li class="group relative">
                    <a href="{{route('edit-profile')}}" class="text-gray-400 hover:text-white"
                        ><i class="fa-solid fa-user fa-xl"></i></a>
                    <span
                    class="pointer-events-none absolute -bottom-10 right-0 w-max 
                        opacity-0 transition-opacity group-hover:opacity-100 bg-gray-400 rounded-md
                        p-2 ml-5"
                    >
                    Edit Profile
                    </span>                
            </li>
            <li class="group relative">
                <a href="{{route('messages', ['conversation'=>null])}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-message fa-xl"></i>
                </a>
                <span
                    class="pointer-events-none absolute -bottom-10 right-0 w-max 
                        opacity-0 transition-opacity group-hover:opacity-100 bg-gray-400 rounded-md
                        p-2 ml-5"
                    >
                    Messages
                </span> 
            </li>
            <li class="group relative">
                <a href="{{route('all-swaps')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-right-left fa-xl"></i>
                </a>
                <span
                    class="pointer-events-none absolute -bottom-10 right-0 w-max 
                        opacity-0 transition-opacity group-hover:opacity-100 bg-gray-400 rounded-md
                        p-2 ml-5"
                    >
                    Swaps
                </span> 
            </li>
            <li class="group relative">
                <a href="{{route('manage-listings')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-gear fa-xl"></i>
                </a>
                <span
                    class="pointer-events-none absolute -bottom-10 right-0 w-max 
                        opacity-0 transition-opacity group-hover:opacity-100 bg-gray-400 rounded-md
                        p-2 ml-5"
                    >
                    Manage Listings
                </span> 
            </li>
            <li>
                <form class="inline" action="{{route('logout')}}" method="POST">
                    @csrf
                    <div class="group relative">
                        <button type="submit" class="text-gray-400 hover:text-white">
                            <i class="fa-solid fa-door-closed fa-xl"></i>
                        </button>
                        <span
                            class="pointer-events-none absolute -bottom-10 right-0 w-max 
                                opacity-0 transition-opacity group-hover:opacity-100 bg-gray-400 rounded-md
                                p-2 ml-5"
                            >
                            Logout
                        </span> 
                    </div>
                    
                </form>
            </li>
            @else
            <li class="group relative">
                <a href="{{route('register')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-user-plus fa-xl"></i>
                </a>
                <span
                    class="pointer-events-none absolute -bottom-10 right-0 w-max 
                        opacity-0 transition-opacity group-hover:opacity-100 bg-gray-400 rounded-md
                        p-2 ml-5"
                    >
                    Register
                </span>
            </li>
            <li class="group relative">
                <a href="{{route('login')}}" class="text-gray-400 hover:text-white"
                    ><i class="fa-solid fa-arrow-right-to-bracket fa-xl"></i>
                </a>
                <span
                    class="pointer-events-none absolute -bottom-10 right-0 w-max 
                        opacity-0 transition-opacity group-hover:opacity-100 bg-gray-400 rounded-md
                        p-2 ml-5"
                    >
                    Login
                </span>
            </li>
            @endauth
        </ul>
    </nav>
    <main class="">
        @yield('content')
    </main>
    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-neutral-900 text-gray-400 h-24 mt-18 opacity-90 md:justify-center"
    >
        <p class="ml-2">ItemSwap | Exchange your items</p>

        <a
            href="{{route('create-listing-form')}}"
            class="absolute top-1/3 right-10 bg-black text-gray-200 py-2 px-5 rounded-lg hover:text-laravel"
            >Post Listing</a
        >
    </footer>
    <x-flash-message/>
</body>
</html>