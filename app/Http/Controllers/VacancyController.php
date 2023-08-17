<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Application;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::with('client')->get();
        return view('vacancies.index', compact('vacancies'));
    }

    public function showApplyForm(Vacancy $vacancy)
    {
        return view('vacancies.apply', compact('vacancy'));
    }

    public function apply(Request $request, Vacancy $vacancy)
    {
        // Validate the submitted data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'expected_salary' => 'required|numeric|min:0',
            'cv_file' => 'required|mimes:pdf|max:2048', // Max 2MB
        ]);

        // Upload and store the CV file
        $cvPath = $request->file('cv_file')->store('cv_files');

        // Create a new application
        Application::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'expected_salary' => $validatedData['expected_salary'],
            'cv_file' => $cvPath,
            'vacancy_id' => $vacancy->id,
        ]);

        return redirect('vacancies')->with('success', 'Application submitted successfully!');
    }
}
