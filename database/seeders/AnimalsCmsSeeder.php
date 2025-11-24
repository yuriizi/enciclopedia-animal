<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnimalsCmsSeeder extends Seeder
{
    public function run()
    {
        $animals = [
            [
                'nome_cientifico' => 'Pandion haliaetus',
                'nome_comum' => 'Águia-pescadora',
                'nome_ingles' => 'Osprey',
                'reino' => 'Animalia',
                'filo' => 'Chordata',
                'classe' => 'Aves',
                'ordem' => 'Accipitriformes',
                'familia' => 'Pandionidae',
                'genero' => 'Pandion',
                'especie' => 'haliaetus',
                'categoria_ameaca' => 'LC',
                'regiao_biogeografica' => 'Cosmopolita',
                'habitat' => 'Habitats aquáticos e semi-aquáticos',
                'descricao_morfologica' => 'Ave de rapina especializada em pesca',
                'biologia_reproducao' => 'Reproduz-se próximo a corpos de água',
                'dieta' => 'Peixe',
                'paises_ocorrencia' => json_encode(['Brasil', 'América do Norte', 'Europa', 'Ásia', 'África']),
                'publicado' => true,
            ],
            [
                'nome_cientifico' => 'Panthera leo',
                'nome_comum' => 'Leão',
                'nome_ingles' => 'Lion',
                'reino' => 'Animalia',
                'filo' => 'Chordata',
                'classe' => 'Mammalia',
                'ordem' => 'Carnivora',
                'familia' => 'Felidae',
                'genero' => 'Panthera',
                'especie' => 'leo',
                'categoria_ameaca' => 'VU',
                'regiao_biogeografica' => 'África subsaariana',
                'habitat' => 'Savanas, grasslands',
                'descricao_morfologica' => 'Grande felino com juba característica',
                'biologia_reproducao' => 'Grupos sociais estruturados',
                'dieta' => 'Carnívoro',
                'paises_ocorrencia' => json_encode(['África']),
                'publicado' => true,
            ],
            [
                'nome_cientifico' => 'Orcinus orca',
                'nome_comum' => 'Orca',
                'nome_ingles' => 'Killer Whale',
                'reino' => 'Animalia',
                'filo' => 'Chordata',
                'classe' => 'Mammalia',
                'ordem' => 'Cetacea',
                'familia' => 'Delphinidae',
                'genero' => 'Orcinus',
                'especie' => 'orca',
                'categoria_ameaca' => 'DD',
                'regiao_biogeografica' => 'Oceanos globais',
                'habitat' => 'Oceano',
                'descricao_morfologica' => 'Golfinho com marcações preto e branco',
                'biologia_reproducao' => 'Matriarquia social complexa',
                'dieta' => 'Peixe e mamíferos marinhos',
                'paises_ocorrencia' => json_encode(['Mundial']),
                'publicado' => true,
            ],
        ];

        foreach ($animals as $data) {
            $data['slug'] = Str::slug($data['nome_cientifico']);
            Animal::create($data);
        }
    }
}
