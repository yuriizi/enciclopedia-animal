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
            --primary: #3F4096;
            --primary-700: #322f78;
            --primary-50: rgba(63,64,150,0.06);
        }

        .bg-primary { background-color: var(--primary) !important; }
        .bg-primary-600 { background-color: var(--primary) !important; }
        .bg-primary-700 { background-color: var(--primary-700) !important; }
        .bg-primary-50 { background-color: var(--primary-50) !important; }

        .text-primary { color: var(--primary) !important; }
        .text-primary-800 { color: var(--primary) !important; }

        .hover\:bg-primary-700:hover { background-color: var(--primary-700) !important; }
        .hover\:text-primary:hover { color: var(--primary) !important; }

        .focus\:shadow-outline-primary:focus { box-shadow: 0 0 0 3px rgba(63,64,150,0.18); outline: none; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold">
                    <a href="{{ route('animais.index') }}">
                        <i class="fas fa-paw mr-2"></i>Enciclopédia Animal
                    </a>
                </h1>
                <nav>
                    <a href="{{ route('animais.index') }}" class="hover:text-primary transition duration-300">
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
            <p>&copy; {{ date('Y') }} Enciclopédia Animal. Todos os direitos reservados.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>