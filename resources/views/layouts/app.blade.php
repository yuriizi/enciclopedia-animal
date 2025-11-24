<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Enciclopédia Animal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #5FB2E1;
            --primary-700: #2E7FA3;
            --primary-50: rgba(95, 178, 225, 0.06);
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .bg-primary-600 {
            background-color: var(--primary) !important;
        }

        .bg-primary-700 {
            background-color: var(--primary-700) !important;
        }

        .bg-primary-50 {
            background-color: var(--primary-50) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-primary-800 {
            color: var(--primary) !important;
        }

        .hover\:bg-primary-700:hover {
            background-color: var(--primary-700) !important;
        }

        .hover\:text-primary:hover {
            color: var(--primary) !important;
        }

        .focus\:shadow-outline-primary:focus {
            box-shadow: 0 0 0 3px rgba(95, 178, 225, 0.18);
            outline: none;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/logo-cop15.png') }}" alt="Logo COP15" class="h-16 w-auto">
                    <div>
                        <h1 class="text-3xl font-bold">
                            <a href="{{ route('animais.index') }}" class="hover:opacity-80 transition">
                                <i class="fas fa-paw mr-2"></i>Enciclopédia Animal
                            </a>
                        </h1>
                        <p class="text-sm text-gray-200">COP15 - Convenção sobre Diversidade Biológica</p>
                    </div>
                </div>
                <nav>
                    <a href="{{ route('animais.index') }}" class="hover:text-gray-200 transition duration-300">
                        <i class="fas fa-home mr-1"></i>Início
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center gap-4 mb-4">
                <img src="{{ asset('images/logo-cop15.png') }}" alt="Logo COP15" class="h-12 w-auto opacity-80">
            </div>
            <p>&copy; {{ date('Y') }} Enciclopédia Animal. Todos os direitos reservados.</p>
            <p class="text-sm text-gray-300 mt-2">COP15 - Convenção sobre Diversidade Biológica</p>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>
