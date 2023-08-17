@extends('layouts.app')

@section('content')
    <h1>Apply for Vacancy</h1>

    <table>
        <thead>
            <tr>
                <th>Header</th>
                <th>Description</th>
                <th>Salary Range</th>
                <th>Available Positions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $vacancy->header }}</td>
                <td>{{ $vacancy->description }}</td>
                <td>{{ $vacancy->salary_min }} - {{ $vacancy->salary_max }}</td>
                <td>{{ $vacancy->available_positions }}</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('vacancies.apply', ['vacancy' => $vacancy->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br>

        <label for="expected_salary">Expected Salary:</label>
        <input type="number" name="expected_salary" step="0.01" required><br>

        <label for="cv_file">CV File:</label>
        <input type="file" name="cv_file" accept=".pdf" required><br>

        <button type="submit">Apply</button>
    </form>
@endsection
