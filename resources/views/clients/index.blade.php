@extends('layouts.app')

@section('content')
    <h1>Company List</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>Number of Vacancies</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->country }}</td>
                    <td>{{ $client->vacancies_count }}</td>
                    <td>
                        @if ($client->vacancies_count > 0)
                            <a href="{{ route('clients.vacancies', ['client' => $client->id]) }}">View Vacancies</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
