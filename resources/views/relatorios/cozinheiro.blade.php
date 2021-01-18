@extends('layouts.app')

@section('content')

    @foreach ($cozinheiros as $cozinheiro)
        {{ $cozinheiro->id }}
    @endforeach

@endsection