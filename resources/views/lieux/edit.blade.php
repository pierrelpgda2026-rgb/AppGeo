@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Modifier le Lieu</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('lieux.update', $lieu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $lieu->nom) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="number" step="any" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $lieu->latitude) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="number" step="any" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $lieu->longitude) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $lieu->type) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Image</label>
                    @if($lieu->image)
                    <div class="mb-2 d-flex align-items-center gap-2">
                        <img src="{{ Storage::url($lieu->image) }}" width="70" height="70"
                            style="object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
                            <small class="text-muted">Image actuelle</small>
                    </div>
                    @endif
                    <input type="file" name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*"
                        onchange="previewImage(this)">
                    <small class="text-muted">Laissez vide pour conserver l'image actuelle.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-2" id="preview-container" style="display:none;">
                        <img id="preview-img" src="#" width="100" height="100"
                            style="object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
                    </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Mettre à jour le Lieu</button>
                        <a href="{{ route('lieux.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection