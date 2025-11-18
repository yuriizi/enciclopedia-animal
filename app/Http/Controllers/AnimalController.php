<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::query()->with('images');

        // Filtros
        if ($request->has('reino') && $request->reino) {
            $query->where('reino', $request->reino);
        }

        if ($request->has('classe') && $request->classe) {
            $query->where('classe', $request->classe);
        }

        if ($request->has('categoria_ameaca') && $request->categoria_ameaca) {
            $query->where('categoria_ameaca', $request->categoria_ameaca);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nome_cientifico', 'like', "%{$search}%")
                  ->orWhere('nome_comum', 'like', "%{$search}%")
                  ->orWhere('nome_ingles', 'like', "%{$search}%");
            });
        }

        // Apenas animais publicados
        $query->where('publicado', true);

        $animais = $query->orderBy('nome_comum')->paginate(12);

        // Dados para os filtros
        $reinos = Animal::where('publicado', true)->distinct()->pluck('reino')->sort();
        $classes = Animal::where('publicado', true)->distinct()->pluck('classe')->sort();
        $categoriasAmeaca = [
            'EX' => 'Extinto',
            'EW' => 'Extinto na Natureza',
            'CR' => 'Criticamente em Perigo',
            'EN' => 'Em Perigo',
            'VU' => 'Vulnerável',
            'NT' => 'Quase Ameaçado',
            'LC' => 'Pouco Preocupante',
            'DD' => 'Dados Deficientes',
            'NE' => 'Não Avaliado'
        ];

        return view('animais.index', compact('animais', 'reinos', 'classes', 'categoriasAmeaca'));
    }

    public function show($slug)
    {
        $animal = Animal::with('images')
            ->where('slug', $slug)
            ->where('publicado', true)
            ->firstOrFail();

        return view('animais.show', compact('animal'));
    }
}