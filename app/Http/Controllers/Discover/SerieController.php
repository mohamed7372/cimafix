<?php

namespace App\Http\Controllers\Discover;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Discover\SerieTopValidator;

class SerieController extends Controller
{
    public function getSerieDetails(Request $request)
    {
        $id = $request->route('id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/tv/'.$id);

        return $response->json();
    }

    public function getSeriesSearch(Request $request)
    {
        $payload = $request->all();
        $page = $payload['page'] ?? 1;
        $query = $payload['query'] ?? '';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/search/tv'.'?query='.$query.'&page='.$page);

        return $response->json();
    }

    public function getSeries(Request $request)
    {
        $payload = $request->all();
        $page = $payload['page'] ?? 1;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/discover/tv'.'?page='.$page);

        return $response->json();
    }

    public function getSeriesTop(SerieTopValidator $request)
    {
        $payload = $request->all();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhOWMxYmFlOGYzOTYwOGI3ODBkYmI5MWIwYTA2ZWUyMCIsInN1YiI6IjY1ODMyMjQzZTI5NWI0M2MwMDY4NmViYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.3mJNZntETshGoPANFHyKHObK4ZkdP9ZBNmDyHYRdAs0',
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/tv/'.$payload['section']);

        $result = $response->json();
        $result = array_slice($result['results'], 0, 5);

        return $result;
    }
}
