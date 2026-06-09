@extends('layouts.main')

@section('title', 'Modifier Type')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('types.index') }}" class="btn btn-sm btn-outline-secondary">← Retour</a>
            <h2 class="fw-semibold mb-0" style="color:#1a2942;">Modifier le Type</h2>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('types.update', $type) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Libellé --}}
                    <div class="mb-3">
                        <label class="form-label fw-medium">Libellé <span class="text-danger">*</span></label>
                           <input type="text" name="libelle"
                               class="form-control @error('libelle') is-invalid @enderror"
                               value="{{ old('libelle', data_get($type, 'libelle', '')) }}">
                        @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div class="mb-4">
                        <label class="form-label fw-medium">Image</label>

                        {{-- Image actuelle --}}
                        @if(data_get($type, 'image'))
                        <div class="mb-2 d-flex align-items-center gap-2">
                            <img src="{{ Storage::url(data_get($type, 'image')) }}"
                                 width="70" height="70"
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

                        {{-- Prévisualisation nouvelle image --}}
                        <div class="mt-2" id="preview-container" style="display:none;">
                            <img id="preview-img" src="#" width="100" height="100"
                                 style="object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('types.index') }}" class="btn btn-outline-secondary w-50">Annuler</a>
                        <button type="submit" class="btn btn-primary w-50">✅ Mettre à jour</button>
                    </div>

                </form>
            </div>
        </div>

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

@endsection