<!doctype html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AutoEquity - Domine o valor financeiro do seu veículo com dados da Tabela FIPE em tempo real.">
    <meta name="theme-color" content="#111827"> <title>@yield('title') - AutoEquity</title>

    <!--fontes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!--css-->
    <link rel="stylesheet" href="css/styles.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen antialiased">

<header class="bg-white/90 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">

            <div class="flex-shrink-0 flex items-center">
                <a href="/" aria-label="AutoEquity Home">
                    <img src="{{ asset('images/mainLogo.png') }}"
                         alt="AutoEquity"
                         class="h-16 md:h-20 w-auto">
                </a>
            </div>

            <nav class="hidden md:flex space-x-8 items-center">
                @guest
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Como funciona</a>
                    <a href="/login" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Login</a>
                    <a href="/register" class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-gray-800 transition shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                        Começar
                    </a>
                @endguest

                @auth
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Dashboard</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Minha garagem</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">FIPE</a>

                    <a href="#" class="bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-700 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Adicionar
                    </a>

                    <form action="/logout" method="post" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 ml-2">
                            Sair
                        </button>
                    </form>
                @endauth
            </nav>

            <div class="flex md:hidden">
                <button type="button" id="mobile-menu-btn" class="text-gray-600 hover:text-gray-900 p-2 focus:outline-none" aria-label="Menu Principal">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
        <div class="px-4 pt-2 pb-6 space-y-2 shadow-lg">
            @guest
                <a href="#" class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Como funciona</a>
                <a href="#" class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Login</a>
            @endguest

            @auth
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Dashboard</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Minha garagem</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Explorar FIPE</a>
                <a href="#" class="block px-3 py-2 mt-2 bg-gray-50 text-gray-900 rounded-md font-medium border border-gray-200 text-center">
                    + Adicionar Carro
                </a>
                <form action="/logout" method="post" class="block w-full">
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
        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} AutoEquity. Todos os direitos reservados.</p>
    </div>
</footer>

<script src="scripts/script.js"></script>

</body>
</html>
