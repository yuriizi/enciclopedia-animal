@extends('layouts.app')

@section('title', "Gerenciar Imagens - {$animal->nome_comum}")

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('animais.show', $animal->slug) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i>Voltar para {{ $animal->nome_comum }}
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-2">Gerenciar Imagens</h1>
        <p class="text-lg text-gray-600 mb-6">{{ $animal->nome_comum }} - <em>{{ $animal->nome_cientifico }}</em></p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-bold mb-4"><i class="fas fa-upload mr-2"></i>Enviar Nova Imagem</h2>
            <form action="{{ route('admin.animais.images.store', $animal->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Imagem (arquivo) *</label>
                    <input type="file" name="imagem" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary" required>
                    @error('imagem') <div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Legenda</label>
                        <input type="text" name="legenda" placeholder="Ex: Vista frontal" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Crédito / Autor</label>
                        <input type="text" name="credito_autor" placeholder="Ex: João Silva" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Fonte</label>
                        <input type="text" name="fonte_imagem" placeholder="Ex: Wikipedia" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary">
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:opacity-90 transition">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>Enviar Imagem
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4"><i class="fas fa-images mr-2"></i>Imagens Existentes</h2>

            @if($animal->images->isEmpty())
                <div class="text-center py-8 text-gray-600">
                    <i class="fas fa-image text-6xl opacity-20 mb-4"></i>
                    <p class="text-lg">Nenhuma imagem cadastrada ainda.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($animal->images as $img)
                        <div class="border border-gray-300 rounded-lg overflow-hidden hover:shadow-lg transition">
                            <div class="bg-gray-200 h-40">
                                <img src="{{ asset('storage/' . $img->caminho_imagem) }}" alt="{{ $img->legenda }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-3">
                                <p class="font-semibold text-gray-800 mb-1">{{ $img->legenda ?? 'Sem legenda' }}</p>
                                @if($img->credito_autor)
                                    <p class="text-xs text-gray-600 mb-2"><i class="fas fa-user mr-1"></i>{{ $img->credito_autor }}</p>
                                @endif
                                @if($img->fonte_imagem)
                                    <p class="text-xs text-gray-600 mb-3"><i class="fas fa-link mr-1"></i>{{ $img->fonte_imagem }}</p>
                                @endif
                                
                                <div class="flex gap-2 flex-wrap">
                                    @if(!$img->destaque)
                                        <form action="{{ route('admin.animais.images.feature', [$animal->slug, $img->id]) }}" method="POST" style="display:inline" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full text-xs bg-blue-500 text-white py-1 rounded hover:bg-blue-600 transition">
                                                <i class="fas fa-star mr-1"></i>Marcar destaque
                                            </button>
                                        </form>
                                    @else
                                        <span class="flex-1 text-xs font-bold text-green-700 bg-green-100 py-1 px-2 rounded text-center">
                                            <i class="fas fa-check-star mr-1"></i>Destaque
                                        </span>
                                    @endif

                                    <form action="{{ route('admin.animais.images.destroy', [$animal->slug, $img->id]) }}" method="POST" onsubmit="return confirm('Remover esta imagem?');" style="display:inline" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-xs bg-red-500 text-white py-1 rounded hover:bg-red-600 transition">
                                            <i class="fas fa-trash mr-1"></i>Remover
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
