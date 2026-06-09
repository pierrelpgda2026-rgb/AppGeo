@extends('layouts.main')

@php
    $typeLabel = is_object($type) ? $type->libelle : $type;
    $typeImage = is_object($type) ? $type->image : null;
@endphp

@section('title', 'Lieux du type : ' . $typeLabel)

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('types.index') }}" class="btn btn-sm btn-outline-secondary">← Retour</a>
    <h2 class="fw-semibold mb-0" style="color:#1a2942;">
        📍 Lieux du type : 
        @if($typeImage)
            <img src="{{ Storage::url($typeImage) }}" width="35" height="35"
                 style="object-fit:cover; border-radius:6px; margin-right:6px;">
        @endif
        {{ $typeLabel }}
    </h2>
</div>

{{-- Statistique --}}
<div class="alert alert-info mb-4">
    <strong>{{ $lieux->total() }}</strong> lieu{{ $lieux->total() > 1 ? 'x' : '' }} trouvé{{ $lieux->total() > 1 ? 's' : '' }}
    pour ce type.
</div>

{{-- Tableau des lieux --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background:#1a2942; color:#fff;">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Nom</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lieux as $lieu)
                <tr>
                    <td class="ps-4 text-muted">{{ $lieu->id }}</td>
                    <td class="fw-medium">{{ $lieu->nom }}</td>
                    <td>{{ $lieu->latitude }}</td>
                    <td>{{ $lieu->longitude }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('lieux.edit', $lieu) }}"
                           class="btn btn-sm btn-outline-warning me-1">✏️ Modifier</a>
                        <form action="{{ route('lieux.destroy', $lieu) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce lieu ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        Aucun lieu pour ce type.
                        <a href="{{ route('lieux.create') }}">Ajouter un lieu</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="mt-3 d-flex justify-content-end">
    {{ $lieux->links() }}
</div>

@endsection