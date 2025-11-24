<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\AnimalImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalImageController extends Controller
{
    public function index(Animal $animal)
    {
        $animal->load('images');
        return view('animais.admin_images', compact('animal'));
    }

    public function store(Request $request, Animal $animal)
    {
        $request->validate([
            'imagem' => 'required|image|max:5120',
            'legenda' => 'nullable|string|max:255',
            'credito_autor' => 'nullable|string|max:255',
            'fonte_imagem' => 'nullable|string|max:255',
        ]);

        $file = $request->file('imagem');
        $path = $file->store('animal_images', 'public');

        $image = AnimalImage::create([
            'animal_id' => $animal->id,
            'caminho_imagem' => $path,
            'legenda' => $request->legenda,
            'credito_autor' => $request->credito_autor,
            'fonte_imagem' => $request->fonte_imagem,
            'destaque' => false,
        ]);

        return redirect()->route('admin.animais.images.index', $animal->slug)
            ->with('success', 'Imagem enviada com sucesso.');
    }

    public function destroy(Animal $animal, AnimalImage $image)
    {
        // Verifica se pertence ao animal
        if ($image->animal_id !== $animal->id) {
            abort(404);
        }

        // Deleta o arquivo armazenado
        if ($image->caminho_imagem && Storage::disk('public')->exists($image->caminho_imagem)) {
            Storage::disk('public')->delete($image->caminho_imagem);
        }

        $image->delete();

        return redirect()->route('admin.animais.images.index', $animal->slug)
            ->with('success', 'Imagem removida.');
    }

    public function setFeatured(Animal $animal, AnimalImage $image)
    {
        if ($image->animal_id !== $animal->id) {
            abort(404);
        }

        // Remove destaque de outras
        AnimalImage::where('animal_id', $animal->id)->update(['destaque' => false]);

        $image->destaque = true;
        $image->save();

        return redirect()->route('admin.animais.images.index', $animal->slug)
            ->with('success', 'Imagem marcada como destaque.');
    }
}
