@extends('layout')

@section('title', 'Result')

@section('content')
    <h3>{{ $result['success'] }} lines inserted successfully.</h3>
    @if( count($result['error']) > 0)
    <h3>count($result['error']) failed:</h3>
    <ul>
    @foreach($result['error'] as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>   
    @endif
@endsection
