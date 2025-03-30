<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Il Nostro Negozio</h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Placeholder for products -->
            <div class="card-elegant rounded-lg overflow-hidden shadow-lg">
                <div class="aspect-w-1 aspect-h-1 w-full">
                    <img src="https://via.placeholder.com/300" alt="Product" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">Prodotto di Esempio</h3>
                    <p class="text-gray-600 mt-2">€99.99</p>
                    <button class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition-colors">
                        Aggiungi al Carrello
                    </button>
                </div>
            </div>

            <!-- More product placeholders -->
            @for ($i = 0; $i < 7; $i++)
                <div class="card-elegant rounded-lg overflow-hidden shadow-lg">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="https://via.placeholder.com/300" alt="Product" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Prodotto di Esempio</h3>
                        <p class="text-gray-600 mt-2">€99.99</p>
                        <button class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition-colors">
                            Aggiungi al Carrello
                        </button>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</x-layout> 