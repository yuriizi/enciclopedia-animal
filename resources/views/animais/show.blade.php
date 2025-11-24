@extends('layouts.app')

@section('title', $animal->nome_comum)

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Cabeçalho -->
        <div class="bg-primary-700 text-white p-6">
            <div class="flex justify-between items-start">
                <div>
                    <div class="mb-4">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-3 py-1.5 bg-white text-primary rounded shadow-sm hover:bg-primary-700 hover:text-white transition">
                            <i class="fas fa-arrow-left mr-2"></i>Voltar
                        </a>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">{{ $animal->nome_comum }}</h1>
                    <p class="text-xl italic mb-4">{{ $animal->nome_cientifico }}</p>
                    @if ($animal->nome_ingles)
                        <p class="text-lg">English: {{ $animal->nome_ingles }}</p>
                    @endif
                </div>
                <div class="text-right">
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
                            'NE' => 'bg-gray-400',
                        ];
                    @endphp
                    <span
                        class="px-3 py-2 text-white rounded-full text-sm font-semibold {{ $badgeColors[$animal->categoria_ameaca] ?? 'bg-gray-400' }}">
                        {{ $categoriasAmeaca[$animal->categoria_ameaca] ?? $animal->categoria_ameaca }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
            <!-- Coluna Principal -->
            <div class="lg:col-span-2">
                <!-- Imagem Principal -->
                @if ($animal->imagem_principal)
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $animal->imagem_principal) }}" alt="{{ $animal->nome_comum }}"
                            class="w-full h-96 object-cover rounded-lg shadow-md">
                    </div>
                @endif

                <!-- Descrição Morfológica -->
                @if ($animal->descricao_morfologica)
                    <section class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">
                            <i class="fas fa-eye mr-2"></i>Descrição Morfológica
                        </h2>
                        <p class="text-gray-700 leading-relaxed">{{ $animal->descricao_morfologica }}</p>
                    </section>
                @endif

                <!-- Habitat -->
                @if ($animal->habitat)
                    <section class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">
                            <i class="fas fa-mountain mr-2"></i>Habitat
                        </h2>
                        <p class="text-gray-700 leading-relaxed">{{ $animal->habitat }}</p>
                    </section>
                @endif

                <!-- Biologia Reprodutiva -->
                @if ($animal->biologia_reproducao)
                    <section class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">
                            <i class="fas fa-egg mr-2"></i>Biologia Reprodutiva
                        </h2>
                        <p class="text-gray-700 leading-relaxed">{{ $animal->biologia_reproducao }}</p>
                    </section>
                @endif

                <!-- Dieta -->
                @if ($animal->dieta)
                    <section class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">
                            <i class="fas fa-utensils mr-2"></i>Dieta
                        </h2>
                        <p class="text-gray-700 leading-relaxed">{{ $animal->dieta }}</p>
                    </section>
                @endif
            </div>

            <!-- Sidebar com Informações Técnicas -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6 shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">
                        <i class="fas fa-info-circle mr-2"></i>Informações Taxonômicas
                    </h3>

                    <div class="space-y-3">
                        <div>
                            <span class="font-semibold text-gray-700">Reino:</span>
                            <span class="text-gray-600">{{ $animal->reino }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Filo:</span>
                            <span class="text-gray-600">{{ $animal->filo }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Classe:</span>
                            <span class="text-gray-600">{{ $animal->classe }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Ordem:</span>
                            <span class="text-gray-600">{{ $animal->ordem }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Família:</span>
                            <span class="text-gray-600">{{ $animal->familia }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Gênero:</span>
                            <span class="text-gray-600">{{ $animal->genero }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Espécie:</span>
                            <span class="text-gray-600">{{ $animal->especie }}</span>
                        </div>
                    </div>

                    <!-- Informações de Conservação -->
                    <h3 class="text-xl font-bold text-gray-800 mt-6 mb-4 border-b pb-2">
                        <i class="fas fa-shield-alt mr-2"></i>Conservação
                    </h3>

                    <div class="space-y-3">
                        @if ($animal->criterios_ameaca)
                            <div>
                                <span class="font-semibold text-gray-700">Critérios de Ameaça:</span>
                                <span class="text-gray-600">{{ $animal->criterios_ameaca }}</span>
                            </div>
                        @endif

                        @if ($animal->ano_avaliacao)
                            <div>
                                <span class="font-semibold text-gray-700">Ano de Avaliação:</span>
                                <span class="text-gray-600">{{ $animal->ano_avaliacao }}</span>
                            </div>
                        @endif

                        @if ($animal->longevidade)
                            <div>
                                <span class="font-semibold text-gray-700">Longevidade:</span>
                                <span class="text-gray-600">{{ $animal->longevidade }}</span>
                            </div>
                        @endif

                        @if ($animal->tamanho_populacao)
                            <div>
                                <span class="font-semibold text-gray-700">Tamanho Populacional:</span>
                                <span class="text-gray-600">{{ $animal->tamanho_populacao }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Países de Ocorrência -->
                    @if ($animal->paises_ocorrencia && count($animal->paises_ocorrencia) > 0)
                        <h3 class="text-xl font-bold text-gray-800 mt-6 mb-4 border-b pb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>Ocorrência
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($animal->paises_ocorrencia as $pais)
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                    {{ $pais }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Galeria de Imagens -->
                @if ($animal->images->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Galeria</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($animal->images as $image)
                                <img src="{{ asset('storage/' . $image->caminho_imagem) }}"
                                    alt="{{ $image->legenda ?? $animal->nome_comum }}"
                                    class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75 transition duration-300"
                                    onclick="openModal('{{ asset('storage/' . $image->caminho_imagem) }}', '{{ $image->legenda ?? '' }}')">
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para imagens -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl max-h-full overflow-auto">
            <div class="p-4">
                <button onclick="closeModal()" class="float-right text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
                <img id="modalImage" src="" alt="" class="w-full h-auto">
                <p id="modalCaption" class="text-center mt-2 text-gray-700"></p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(src, caption) {
            document.getElementById('modalImage').src = src;
            document.getElementById('modalCaption').textContent = caption;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Fechar modal com ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection
