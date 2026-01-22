<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThingController extends Controller
{
    public function index()
    {
        $things = Thing::where('master_id', Auth::id())->get();
        return view('things.index', compact('things'));
    }

    public function create()
    {
        return view('things.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'wrnt' => 'nullable|date',
        ]);

        Thing::create([
            'name' => $request->name,
            'description' => $request->description,
            'wrnt' => $request->wrnt,
            'master_id' => Auth::id(),
        ]);

        return redirect()->route('things.index')->with('success', 'Вещь создана успешно.');
    }

    public function show(Thing $thing)
    {
        return view('things.show', compact('thing'));
    }

    public function edit(Thing $thing)
    {
        return view('things.edit', compact('thing'));
    }

    public function update(Request $request, Thing $thing)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'wrnt' => 'nullable|date',
        ]);

        $thing->update($request->all());

        return redirect()->route('things.index')->with('success', 'Вещь обновлена успешно.');
    }

    public function destroy(Thing $thing)
    {
        $thing->delete();
        return redirect()->route('things.index')->with('success', 'Вещь удалена успешно.');
    }
}