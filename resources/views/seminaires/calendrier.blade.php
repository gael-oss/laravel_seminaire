@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Calendrier des Séminaires Programmes</h1>
    
    <div class="row">
        @foreach($seminaires as $seminaire)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    {{ $seminaire->titre }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <i class="bi bi-person"></i> {{ $seminaire->presentateur->user->name }}<br>
                        <i class="bi bi-bookmark"></i> {{ $seminaire->theme->nom }}<br>
                        <i class="bi bi-clock"></i> {{ $seminaire->date_presentation->format('d/m/Y H:i') }}
                    </p>
                    @if($seminaire->fichier)
                    <a href="{{ route('seminaires.download', $seminaire) }}" 
                       class="btn btn-success btn-sm">
                        <i class="bi bi-download"></i> Présentation
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
