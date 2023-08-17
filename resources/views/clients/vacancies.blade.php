@extends('layouts.app')

@section('content')
    <h1>Vacancies for {{ $client->name }}</h1>

    <table>
        <thead>
            <tr>
                <th>Header</th>
                <th>Description</th>
                <th>Salary Range</th>
                <th>Available Positions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vacancies as $vacancy)
                <tr>
                    <td>{{ $vacancy->header }}</td>
                    <td>{{ $vacancy->description }}</td>
                    <td>{{ $vacancy->salary_min }} - {{ $vacancy->salary_max }}</td>
                    <td>{{ $vacancy->available_positions }}</td>
                    <td><a href="{{ route('vacancies.apply', ['vacancy' => $vacancy->id]) }}">Apply</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
