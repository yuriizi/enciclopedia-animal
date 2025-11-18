@extends('layouts.app')

@section('title', 'Enciclopédia Animal')

@section('content')
    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Filtrar Animais</h2>
        
        <form action="{{ route('animais.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Busca por Nome -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search mr-1"></i>Buscar por nome
                </label>
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Nome científico, comum ou em inglês"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:shadow-outline-primary">
            </div>

            <!-- Filtro por Reino -->
            <div>
                <label for="reino" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-globe mr-1"></i>Reino
                </label>
                <select name="reino" 
                        id="reino"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:shadow-outline-primary">
                    <option value="">Todos os reinos</option>
                    @foreach($reinos as $reino)
                        <option value="{{ $reino }}" {{ request('reino') == $reino ? 'selected' : '' }}>
                            {{ $reino }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por Classe -->
            <div>
                <label for="classe" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-fish mr-1"></i>Classe
                </label>
                <select name="classe" 
                        id="classe"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:shadow-outline-primary">
                    <option value="">Todas as classes</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe }}" {{ request('classe') == $classe ? 'selected' : '' }}>
                            {{ $classe }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por Categoria de Ameaça -->
            <div>
                <label for="categoria_ameaca" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-exclamation-triangle mr-1"></i>Status de Conservação
                </label>
                <select name="categoria_ameaca" 
                        id="categoria_ameaca"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:shadow-outline-primary">
                    <option value="">Todas as categorias</option>
                    @foreach($categoriasAmeaca as $key => $value)
                        <option value="{{ $key }}" {{ request('categoria_ameaca') == $key ? 'selected' : '' }}>
                            {{ $value }} ({{ $key }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botões -->
            <div class="md:col-span-2 lg:col-span-4 flex gap-4">
                <button type="submit" 
                    class="bg-primary-600 text-white px-6 py-2 rounded-md hover:bg-primary-700 transition duration-300">
                    <i class="fas fa-filter mr-2"></i>Aplicar Filtros
                </button>
                <a href="{{ route('animais.index') }}" 
                   class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition duration-300">
                    <i class="fas fa-times mr-2"></i>Limpar Filtros
                </a>
            </div>
        </form>

        <!-- Resultados da Busca -->
        @if(request()->anyFilled(['search', 'reino', 'classe', 'categoria_ameaca']))
            <div class="mt-4 p-4 bg-primary-50 rounded-md">
                <p class="text-primary">
                    <i class="fas fa-info-circle mr-2"></i>
                    Mostrando resultados para:
                    @if(request('search')) <span class="font-semibold">"{{ request('search') }}"</span> @endif
                    @if(request('reino')) <span class="font-semibold">Reino: {{ request('reino') }}</span> @endif
                    @if(request('classe')) <span class="font-semibold">Classe: {{ request('classe') }}</span> @endif
                    @if(request('categoria_ameaca')) 
                        <span class="font-semibold">Status: {{ $categoriasAmeaca[request('categoria_ameaca')] }}</span>
                    @endif
                </p>
            </div>
        @endif
    </div>

    <!-- Grid de Animais -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            @if($animais->total() > 0)
                {{ $animais->total() }} animal(ais) encontrado(s)
            @else
                Nenhum animal encontrado
            @endif
        </h2>

        @if($animais->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($animais as $animal)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Imagem -->
                        <div class="h-48 bg-gray-200 relative">
                            @if($animal->imagem_principal)
                                <img src="{{ asset('storage/' . $animal->imagem_principal) }}" 
                                     alt="{{ $animal->nome_comum }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-paw text-4xl"></i>
                                </div>
                            @endif
                            
                            <!-- Badge Status Conservação -->
                            <div class="absolute top-2 right-2">
                                @php
                                    $badgeColors = [
                                        'EX' => 'bg-gray-600',
                                        'EW' => 'bg-gray-500',
                                        'CR' => 'bg-red-600',
                                        'EN' => 'bg-orange-600',
                                        'VU' => 'bg-yellow-600',
                                        'NT' => 'bg-blue-400',
                                        'LC' => 'bg-primary-600',
                                        'DD' => 'bg-purple-600',
                                        'NE' => 'bg-gray-400'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs text-white rounded-full {{ $badgeColors[$animal->categoria_ameaca] ?? 'bg-gray-400' }}">
                                    {{ $animal->categoria_ameaca }}
                                </span>
                            </div>
                        </div>

                        <!-- Informações -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $animal->nome_comum }}</h3>
                            <p class="text-sm text-gray-600 italic mb-2">{{ $animal->nome_cientifico }}</p>
                            
                            <div class="text-xs text-gray-500 space-y-1">
                                <p><span class="font-semibold">Reino:</span> {{ $animal->reino }}</p>
                                <p><span class="font-semibold">Classe:</span> {{ $animal->classe }}</p>
                                <p><span class="font-semibold">Família:</span> {{ $animal->familia }}</p>
                            </div>

                                     <a href="{{ route('animais.show', $animal->slug) }}" 
                                         class="mt-4 block w-full bg-primary-600 text-white text-center py-2 rounded-md hover:bg-primary-700 transition duration-300">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="mt-8">
                {{ $animais->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Nenhum animal encontrado</h3>
                <p class="text-gray-500">Tente ajustar os filtros ou buscar por outros termos.</p>
            </div>
        @endif
    </div>
@endsection