@extends('layout')

@section('title', 'Import CSV File')

@section('content')
    {{ Form::open(['files' => true]) }}
        {{ Form::file('file') }}
        {{ Form::submit() }}
    {{ Form::close() }}
@endsection
