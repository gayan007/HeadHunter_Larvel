@extends('layouts.app')

@section('content')
    <h1>Generated Report - pipeline</h1>

    <table>
        <thead>
            <tr>
                <th>Vacancy ID</th>
                <th>Vacancy Header</th>
                <th>Client Name</th>
                <th>Client Currency Code</th>
                <th>Total Expected Salary</th>
                <th>Average Expected Salary</th>
                <th>Application count</th>
                <th>Total USD Equivalent</th>
                <th>Total USD Commission</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->header }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->currency_code }}</td>
                    <td>{{ $item->total_expected_salary }}</td>
                    <td>{{ $item->avg_expected_salary }}</td>
                    <td>{{ $item->application_count }}</td>
                    <td>{{ $item->usd_equivalent_total }}</td>
                    <td>{{ $item->usd_equivalent_total_commission }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
