@extends("layouts.master")

@section("nav")
    <a class="nav-link active">Clubs</a>
    <a class="nav-link" href="{{ route('input-score') }}">Input Score</a>
    <a class="nav-link" href="{{ route('standings') }}">Standings</a>
@endsection

@section("content")
    @livewire('club')
@endsection