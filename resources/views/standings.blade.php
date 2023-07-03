@extends("layouts.master")

@section("nav")
    <a class="nav-link" href="{{ route('club') }}">Clubs</a>
    <a class="nav-link" href="{{ route('input-score') }}">Input Score</a>
    <a class="nav-link active">Standings</a>
@endsection

@section("content")
    @livewire('standing')
@endsection