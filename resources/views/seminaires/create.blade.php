@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Programmer un nouveau séminaire</h1>
    <form action="{{ route('seminaires.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Titre du séminaire</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date et heure</label>
            <input type="datetime-local" name="date_presentation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Présentateur</label>
            <select name="presentateur_id" class="form-select" required>
                @foreach($presentateurs as $presentateur)
                    <option value="{{ $presentateur->id }}">{{ $presentateur->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Thème</label>
            <select name="theme_id" class="form-select" required>
                @foreach($themes as $theme)
                    <option value="{{ $theme->id }}">{{ $theme->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fichier de présentation (PDF/PPT)</label>
            <input type="file" name="fichier" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Valider</button>
    </form>
</div>
@endsection
