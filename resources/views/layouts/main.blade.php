<!doctype html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AutoEquity - Domine o valor financeiro do seu veículo.">
    <meta name="theme-color" content="#111827">
    <title>@yield('title') - AutoEquity</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/mainLogo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen antialiased font-sans">

<header class="bg-white/90 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">

            <div class="flex-shrink-0 flex items-center">
                <a href="/" aria-label="AutoEquity Home">
                    <img src="{{ asset('images/mainLogo.png') }}" alt="AutoEquity" class="h-10 md:h-12 w-auto">
                </a>
            </div>

            <nav class="hidden md:flex space-x-8 items-center">
                @guest
                    <a href="/login" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Entrar</a>
                    <a href="/register" class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-gray-800 transition shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                        Criar Conta
                    </a>
                @endguest

                @auth
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Início</a>
                    <a href="{{ route('garage.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Minha Garagem</a>

                    <div class="relative ml-3">
                        <div>
                            <button type="button" class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Abrir menu de usuário</span>
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="h-9 w-9 rounded-full object-cover border border-gray-200" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @else
                                    <div class="h-9 w-9 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold uppercase border border-emerald-200">
                                        {{ substr(Auth::user()->name, 0, 2) }}
                                    </div>
                                @endif
                            </button>
                        </div>

                        <div class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-xl bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" id="user-menu-dropdown">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-500">Logado como</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" role="menuitem">Configurações</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50" role="menuitem">Sair</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </nav>

            <div class="flex md:hidden">
                <button type="button" id="mobile-menu-btn" class="text-gray-600 hover:text-gray-900 p-2 focus:outline-none">
                    <ion-icon name="menu-outline" class="text-3xl"></ion-icon>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-xl">
        <div class="px-4 pt-2 pb-6 space-y-2">
            @guest
                <a href="/login" class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Entrar</a>
                <a href="/register" class="block px-3 py-3 rounded-md text-base font-medium bg-gray-900 text-white hover:bg-gray-800 text-center">Criar Conta</a>
            @endguest

            @auth
                <div class="flex items-center px-3 py-3 border-b border-gray-100 mb-2">
                    <div class="mr-3">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="" />
                        @else
                            <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Dashboard</a>
                <a href="{{ route('garage.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Minha Garagem</a>
                <a href="{{ route('profile.show') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Perfil</a>

                <form action="{{ route('logout') }}" method="post" class="block w-full mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-red-600 font-medium hover:bg-red-50 rounded-md">
                        Sair da conta
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>

<main class="flex-grow w-full relative">
    @yield('content')
</main>

<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto py-8 px-4 text-center">
        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Gabriel Vinicius de Oliveira. Todos os direitos reservados.</p>
    </div>
</footer>

<script src="{{ asset('scripts/script.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

@livewireScripts

</body>
</html>
