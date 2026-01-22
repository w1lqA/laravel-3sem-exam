<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use App\Models\Thing;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsageController extends Controller
{
    public function index()
    {
        $usages = Usage::with(['thing', 'place', 'user'])->get();
        return view('usages.index', compact('usages'));
    }

    public function create()
    {
        $things = Thing::where('master_id', Auth::id())->get();
        $places = Place::all();
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('usages.create', compact('things', 'places', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'thing_id' => 'required|exists:things,id',
            'place_id' => 'required|exists:places,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:1',
        ]);

        Usage::create([
            'thing_id' => $request->thing_id,
            'place_id' => $request->place_id,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('usages.index')->with('success', 'Запись об использовании создана.');
    }

    public function show(Usage $usage)
    {
        return view('usages.show', compact('usage'));
    }

    public function edit(Usage $usage)
    {
        $things = Thing::where('master_id', Auth::id())->get();
        $places = Place::all();
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('usages.edit', compact('usage', 'things', 'places', 'users'));
    }

    public function update(Request $request, Usage $usage)
    {
        $request->validate([
            'thing_id' => 'required|exists:things,id',
            'place_id' => 'required|exists:places,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:1',
        ]);

        $usage->update([
            'thing_id' => $request->thing_id,
            'place_id' => $request->place_id,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('usages.index')->with('success', 'Запись об использовании обновлена.');
    }

    public function destroy(Usage $usage)
    {
        $usage->delete();
        return redirect()->route('usages.index')->with('success', 'Запись об использовании удалена.');
    }
}