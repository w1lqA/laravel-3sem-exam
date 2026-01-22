<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'repair' => 'boolean',
            'work' => 'boolean',
        ]);

        Place::create([
            'name' => $request->name,
            'description' => $request->description,
            'repair' => $request->boolean('repair'),
            'work' => $request->boolean('work'),
        ]);

        return redirect()->route('places.index')->with('success', 'Место создано успешно.');
    }

    public function show(Place $place)
    {
        return view('places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'repair' => 'boolean',
            'work' => 'boolean',
        ]);

        $place->update([
            'name' => $request->name,
            'description' => $request->description,
            'repair' => $request->boolean('repair'),
            'work' => $request->boolean('work'),
        ]);

        return redirect()->route('places.index')->with('success', 'Место обновлено успешно.');
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('places.index')->with('success', 'Место удалено успешно.');
    }
}