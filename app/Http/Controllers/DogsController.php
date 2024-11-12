<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DogsController extends Controller
{
    public function index(Request $request)
    {
        $breed = null;
        $breeds = null;
        $dogs = null;

        $breed_api = Http::get('https://dog.ceo/api/breeds/list/all');

        if ($breed_api->status() == 200) {
            $breeds = $breed_api->json()['message'];
        }

        if ($request->has('breed')) {
            $breed = $request->get('breed');
            $dogs_api = Http::get('https://dog.ceo/api/breed/' . $breed . '/images');

            if ($dogs_api->status() == 200) {
                $dogs = $dogs_api->json()['message'];
            }
        }

        return Inertia::render('Dogs', [
            'breed' => $breed,
            'breeds' => $breeds,
            'dogs' => $dogs
        ]);
    }

    public function addToFavorite(Request $request)
    {
        if ($request->has('url') || $request->has('breed')) {

            $favorites_count = Favorite::where('user_id', auth()->user()->id)->count();

            if ($favorites_count < 3) {
                Favorite::create([
                    'user_id' => auth()->user()->id,
                    'image_url' => $request->get('url')
                ]);

                return Redirect::route('favorite.index');
            }

            return Redirect::back();
        }
    }

    public function removeToFavorite(Request $request)
    {
        if ($request->has('id')) {
            $fave = Favorite::find($request->get('id'));
            $fave->delete();

            return Redirect::back();
        }
    }
}
