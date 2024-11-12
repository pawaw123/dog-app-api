<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FavoritesController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('user')->get();

        return Inertia::render('Favorite/Index', [
            'favorites' => $favorites,
        ]);
    }

    public function edit(Request $request, Favorite $favorite)
    {
        return Inertia::render('Favorite/Edit', [
            'favorite' => $favorite->load('user'),
        ]);
    }

    public function delete(Favorite $favorite)
    {
        $favorite->delete();

        return Redirect::route('favorite.index');
    }
}
