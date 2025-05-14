@foreach($seminaires as $seminaire)
<tr>
    <td>{{ $seminaire->titre }}</td>
    <td>{{ $seminaire->presentateur->user->name }}</td>
    <td>{{ $seminaire->theme->nom }}</td>
    <td>
        <a href="{{ Storage::url($seminaire->resume_path) }}" 
           class="btn btn-sm btn-info"
           download>
            <i class="fas fa-download"></i> PDF
        </a>
    </td>
    <td class="d-flex gap-2">
        <form method="POST" action="{{ route('seminaires.valider', $seminaire) }}">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-check"></i> Valider
            </button>
        </form>
        
        <button type="button" 
                class="btn btn-danger btn-sm" 
                data-bs-toggle="modal" 
                data-bs-target="#rejetModal{{ $seminaire->id }}">
            <i class="fas fa-times"></i> Rejeter
        </button>
    </td>
</tr>

<!-- Modal de rejet -->
<div class="modal fade" id="rejetModal{{ $seminaire->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('seminaires.rejeter', $seminaire) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Rejeter la demande</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Motif du rejet :</label>
                        <textarea name="raison" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
