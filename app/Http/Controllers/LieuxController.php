<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Type;

class LieuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lieux = Lieu::with('type')->paginate(5);
        return view('lieux.index', compact('lieux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $types = Type::all();
        return view('lieux.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_id'   => 'required|exists:types,id',
        ]);

        Lieu::create($validatedData);

        return redirect()->route('lieux.index')->with('success', 'Lieu créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lieu = Lieu::findOrFail($id);
        return view('lieux.show', compact('lieu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $lieu = Lieu::findOrFail($id);
        return view('lieux.edit', compact('lieu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_id'   => 'required|exists:types,id',
        ]);

        $lieu = Lieu::findOrFail($id);
        $lieu->update($validatedData);

        return redirect()->route('lieux.index')->with('success', 'Lieu mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lieu = Lieu::findOrFail($id);
        $lieu->delete();

        return redirect()->route('lieux.index')->with('success', 'Lieu supprimé avec succès.');
    }
}
