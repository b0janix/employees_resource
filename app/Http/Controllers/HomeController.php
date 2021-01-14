<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getPublicAuthDetails(): JsonResponse
    {
        $clients = auth()->user()->clients;
        $responseArr = [];
        foreach ($clients as $client) {
            $responseArr[] = [
                'client_id' => $client->client_id,
                'client_name' => $client->client_name,
                'redirect_uri' => $client->redirect_uri
            ];
        }
        return response()->json($responseArr);
    }
}
