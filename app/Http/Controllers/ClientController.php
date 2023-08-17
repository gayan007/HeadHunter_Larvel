<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::has('vacancies')->withCount('vacancies')->get();
        return view('clients.index', compact('clients'));
    }

    public function vacancies(Client $client)
    {
        $vacancies = $client->vacancies;
        return view('clients.vacancies', compact('vacancies', 'client'));
    }
}
