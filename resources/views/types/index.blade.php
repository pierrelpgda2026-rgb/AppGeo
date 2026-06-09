@extends('layouts.main')

@section('title', 'Liste des Types')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold" style="color:#1a2942;">🏷️ Types</h2>
    <a href="{{ route('types.create') }}" class="btn btn-primary">
        + Nouveau Type
    </a>
</div>



@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form method="GET" action="{{ route('types.index') }}" class="mb-4">
    <div class="input-group" style="max-width: 400px;">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Rechercher un type..."
               value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary">🔍</button>
        @if($search)
            <a href="{{ route('types.index') }}" class="btn btn-outline-secondary">✕</a>
        @endif
    </div>
</form>

@if($search)
    <p class="text-muted mb-3">
        Résultats pour : <strong>{{ $search }}</strong>
        ({{ $types->total() }} trouvé{{ $types->total() > 1 ? 's' : '' }})
    </p>
@endif


<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background:#1a2942; color:#fff;">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Libellé</th>
                    <th>Image</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($types as $type)
                <tr>
                    <td class="ps-4 text-muted">{{ $type->id }}</td>
                    <td class="fw-medium">{{ $type->libelle }}</td>
                    <td>
                        @if($type->image)
                            <img src="{{ Storage::url($type->image) }}"
                                 width="50" height="50"
                                 style="object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
                        @else
                            <span class="text-muted fst-italic">Aucune image</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <a href="{{ route('types.show', $type) }}" class="btn btn-sm btn-outline-info me-1">
                                 Lieux
                        </a>
                        <a href="{{ route('types.edit', $type) }}"
                           class="btn btn-sm btn-outline-warning me-1">
                             Modifier
                        </a>
                        <form action="{{ route('types.destroy', $type) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce type ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                 Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        Aucun type trouvé. 
                        <a href="{{ route('types.create') }}">Créer le premier</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="mt-3 d-flex justify-content-end">
    @if(is_object($types) && method_exists($types, 'links'))
        {{ $types->links() }}
    @endif
</div>

@endsection