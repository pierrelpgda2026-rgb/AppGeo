<?php

namespace App\Http\Controllers;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $types = Type::when($search, function ($query, $search) {
                    $query->where('libelle', 'ilike', '%' . $search . '%'); // ilike = insensible à la casse sur PostgreSQL
                })
                ->latest()
                ->paginate(10)
                ->withQueryString(); // ← garde le paramètre search dans la pagination

    return view('types.index', compact('types', 'search'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'libelle' => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('types', 'public');
        }

        Type::create($data);
        return redirect()->route('types.index')->with('success', 'Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
{
    $lieux = $type->lieux()->paginate(10);
    return view('types.show', compact('type', 'lieux'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Type::findOrFail($id);
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = Type::findOrFail($id);

        $data = $request->validate([
            'libelle' => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('types', 'public');
        }

        $type->update($data);
        return redirect()->route('types.index')->with('success', 'Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Type deleted successfully.');
    }
}
