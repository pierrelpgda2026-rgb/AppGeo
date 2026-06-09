@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Liste des Lieux</h2>
                    <a href="{{ route('lieux.create') }}" class="btn btn-primary float-end">Ajouter un Lieu</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($lieux->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Type</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lieux as $lieu)
                                    <tr>
                                        <td>{{ $lieu->id }}</td>
                                        <td>{{ $lieu->nom }}</td>
                                        <td>{{ $lieu->latitude }}</td>
                                        <td>{{ $lieu->longitude }}</td>
                                        <td>{{ $lieu->type->libelle ?? '—' }}</td> 
                                        <td>
                                            @if($lieu->image)
                                                <img src="{{ Storage::url($lieu->image) }}" width="50" height="50"
                                                    style="object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
                                            @else
                                                <span class="text-muted fst-italic">Aucune</span>
                                            @endif
                                        </td>
                                        <td>  {{-- ← balise ouvrante manquante ! --}}
                                            <a href="{{ route('lieux.edit', $lieu->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('lieux.destroy', $lieu->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce lieu ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $lieux->links() }}
                    @else
                        <p>Aucun lieu trouvé.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection