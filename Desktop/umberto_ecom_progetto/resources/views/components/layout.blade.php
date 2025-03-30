<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Negozio Online') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Stili Aggiuntivi -->
    <style>
        .bg-gradient-elegant {
            background: linear-gradient(135deg, #f6f8fc 0%, #e9edf5 100%);
        }
        .card-elegant {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
    </style>
    {{ $styles ?? '' }}
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-elegant">
        <!-- Navigazione -->
        @include('components.navbar')

        <!-- Messaggi Flash -->
        @if (session()->has('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Contenuto Pagina -->
        <main class="py-12">
            {{ $slot }}
        </main>

        <!-- Piè di pagina -->
        @include('components.footer')
    </div>

    <!-- Script -->
    <script>
        // Funzioni JavaScript comuni
        function showAlert(message, type = 'success') {
            alert(message);
        }

        // Gestione Token CSRF per richieste AJAX
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').content;
        }

        // Wrapper comune per fetch con gestione CSRF
        async function fetchWithCsrf(url, options = {}) {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            };

            const mergedOptions = {
                ...defaultOptions,
                ...options,
                headers: {
                    ...defaultOptions.headers,
                    ...(options.headers || {})
                }
            };

            try {
                const response = await fetch(url, mergedOptions);
                if (!response.ok) {
                    throw new Error('Errore nella risposta della rete');
                }
                return await response.json();
            } catch (error) {
                console.error('Errore fetch:', error);
                throw error;
            }
        }
    </script>

    <!-- Script Aggiuntivi -->
    @stack('scripts')
    {{ $scripts ?? '' }}
</body>
</html> 