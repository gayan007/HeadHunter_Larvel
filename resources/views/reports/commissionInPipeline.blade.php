@extends('layouts.app')

@section('content')
    <h1>Commission in the Pipeline Report</h1>

    <p>Total Commission in the Pipeline: ${{ number_format($totalCommission, 2) }}</p>
@endsection