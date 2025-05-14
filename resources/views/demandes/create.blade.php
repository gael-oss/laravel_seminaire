@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nouvelle demande de séminaire</h1>
    <form action="{{ route('demandes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Titre de la présentation</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Thème</label>
            <select name="theme_id" class="form-select" required>
                @foreach($themes as $theme)
                    <option value="{{ $theme->id }}">{{ $theme->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Résumé (PDF)</label>
            <input type="file" name="resume" class="form-control" accept=".pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>
@endsection
