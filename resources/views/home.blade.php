@extends('layouts.main_layout')
@section('content')

{{-- apresentar o nome a partir da Route::view --}}

@if(!empty($myName))
    <p>{{ $myName}} </p>
@endif

@endsection
