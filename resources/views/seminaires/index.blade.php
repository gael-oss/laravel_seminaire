@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Séminaires</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Présentateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seminaires as $seminaire)
                <tr>
                    <td>{{ $seminaire->titre }}</td>
                    <td>{{ $seminaire->date_presentation->format('d/m/Y H:i') }}</td>
                    <td>{{ $seminaire->presentateur->nom }}</td>
                    <td>
                        <a href="{{ route('seminaires.edit', $seminaire) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('seminaires.destroy', $seminaire) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('seminaires.create') }}" class="btn btn-success">Créer un séminaire</a>
</div>
@endsection
