@extends("layouts.master")

@section("nav")
    <a class="nav-link" href="{{ route('club') }}">Clubs</a>
    <a class="nav-link active">Input Score</a>
    <a class="nav-link" href="{{ route('standings') }}">standings</a>
@endsection

@section("content")
    @livewire('input-score')
@endsection