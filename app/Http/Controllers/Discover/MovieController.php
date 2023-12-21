<?php

namespace App\Http\Controllers\Discover;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Discover\MovieTopValidator;


class MovieController extends Controller
{
    public function getMovieDetails(Request $request)
    {
        $id = $request->route('id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/movie/'.$id);

        return $response->json();
    }

    public function getMoviesSearch(Request $request)
    {
        $payload = $request->all();
        $page = $payload['page'] ?? 1;
        $query = $payload['query'] ?? '';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/search/movie'.'?query='.$query.'&page='.$page);

        return $response->json();
    }

    public function getMovies(Request $request)
    {
        $payload = $request->all();
        $page = $payload['page'] ?? 1;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/discover/movie'.'?page='.$page);

        return $response->json();
    }

    public function getMoviesTop(MovieTopValidator $request)
    {
        $payload = $request->all();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/movie/'.$payload['section']);

        $result = $response->json();
        $result = array_slice($result['results'], 0, 5);

        return $result;
    }
}
