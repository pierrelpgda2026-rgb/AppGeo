@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Ajouter un Nouveau Lieu</h2>
                </div>
                

                <div class="card-body">
                    <form action="{{ route('lieux.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
                        
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="number" step="any" class="form-control" id="latitude" name="latitude" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="number" step="any" class="form-control" id="longitude" name="longitude" required>
                        </div>
                        
                        <div class="mb-3">
    <label class="form-label fw-medium">Type <span class="text-danger">*</span></label>
    <select name="type_id" class="form-select @error('type_id') is-invalid @enderror">
        <option value="">-- Choisir un type --</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                {{ $type->libelle }}
            </option>
        @endforeach
    </select>
    @error('type_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="mb-4">
    <label class="form-label fw-medium">Image</label>
    <input type="file" name="image"
           class="form-control @error('image') is-invalid @enderror"
           accept="image/*"
           onchange="previewImage(this)">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="mt-2" id="preview-container" style="display:none;">
        <img id="preview-img" src="#" width="100" height="100"
             style="object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
    </div>
</div>

<script>
function previewImage(input) {
    const container = document.getElementById('preview-container');
    const img = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; container.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</div>
                        
                        <button type="submit" class="btn btn-primary">Créer le Lieu</button>
                        <a href="{{ route('lieux.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection