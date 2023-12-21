<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request, User $user)
    {
        $payload = $request->all();

        $favorite = $user->favorites()->create([
            'discover_id' => $payload['discover'],
            'type' => $payload['type'],
        ]);

        $response = [
            'success' => true,
            'message' => "Favorite added successful."
        ];

        return response()->json($response, 201);
    }

    public function deleteFavorite(Favorite $favorite)
    {
        if(!Auth::check())
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'No user is currently logged in.',
            ], Response::HTTP_UNAUTHORIZED);

        $favorite->delete();

        $response = [
            'success' => true,
            'message' => "Favorite deleted successfully."
        ];

        return response()->json($response, 201);
    }

    public function getAllFavorites(Request $request)
    {
        if(!Auth::check())
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'No user is currently logged in.',
            ], Response::HTTP_UNAUTHORIZED);

        $user = Auth::user();

        $favorites = $user->favorites;

        return response()->json([
            'success' => true,
            'favorites' => $favorites,
        ], Response::HTTP_OK);
    }

}
