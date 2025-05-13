@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $seminaire->titre }}</h1>
    <p>Date : {{ $seminaire->date_presentation->format('d/m/Y H:i') }}</p>
    <p>Présentateur : {{ $seminaire->presentateur->nom }}</p>
    <p>Thème : {{ $seminaire->theme->nom }}</p>
    @if($seminaire->fichier)
        <a href="{{ route('seminaires.download', $seminaire) }}" class="btn btn-info">Télécharger le fichier</a>
    @endif
</div>
@endsection
