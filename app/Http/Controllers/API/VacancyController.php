<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    public function addVacancy(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'header' => 'required|string',
            'description' => 'required|string',
            'salary_min' => 'required|numeric',
            'salary_max' => 'required|numeric',
            'client_id' => 'required|exists:clients,id',
            'available_positions' => 'required|integer',
        ]);

        // // Create a new vacancy
        Vacancy::create($validatedData);

        return response()->json(['message' => 'Vacancy added successfully'], 201);
    }
}
