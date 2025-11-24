<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Imagens - {{ $animal->nome_comum }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Imagens de: {{ $animal->nome_comum }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-4 rounded shadow mb-6">
            <form action="{{ route('admin.animais.images.store', $animal->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="block text-sm font-medium">Imagem (arquivo)</label>
                    <input type="file" name="imagem" accept="image/*" class="mt-1">
                    @error('imagem') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm font-medium">Legenda</label>
                        <input type="text" name="legenda" class="mt-1 block w-full border rounded px-2 py-1">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Crédito / Autor</label>
                        <input type="text" name="credito_autor" class="mt-1 block w-full border rounded px-2 py-1">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Fonte</label>
                        <input type="text" name="fonte_imagem" class="mt-1 block w-full border rounded px-2 py-1">
                    </div>
                </div>

                <div class="mt-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Enviar imagem</button>
                    <a href="{{ route('animais.show', $animal->slug) }}" class="ml-3 text-sm text-gray-600">Voltar para a página do animal</a>
                </div>
            </form>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-3">Imagens existentes</h2>

            @if($animal->images->isEmpty())
                <div class="text-gray-600">Nenhuma imagem cadastrada.</div>
            @else
                <div class="grid grid-cols-3 gap-4">
                    @foreach($animal->images as $img)
                        <div class="border rounded overflow-hidden bg-gray-50 p-2">
                            <img src="{{ asset('storage/' . $img->caminho_imagem) }}" alt="{{ $img->legenda }}" class="w-full h-40 object-cover mb-2">
                            <div class="text-sm text-gray-700 mb-2">{{ $img->legenda ?? '—' }}</div>
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500">{{ $img->credito_autor ?? '' }}</div>
                                <div class="flex items-center space-x-2">
                                    @if(!$img->destaque)
                                        <form action="{{ route('admin.animais.images.feature', [$animal->slug, $img->id]) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button class="text-xs text-blue-600">Marcar destaque</button>
                                        </form>
                                    @else
                                        <span class="text-xs font-semibold text-green-700">Destaque</span>
                                    @endif

                                    <form action="{{ route('admin.animais.images.destroy', [$animal->slug, $img->id]) }}" method="POST" onsubmit="return confirm('Remover imagem?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs text-red-600">Remover</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>
</html>
