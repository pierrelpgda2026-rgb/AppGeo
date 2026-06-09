@extends('layouts.main')

@section('title', 'Nouveau Type')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('types.index') }}" class="btn btn-sm btn-outline-secondary">← Retour</a>
            <h2 class="fw-semibold mb-0" style="color:#1a2942;">Nouveau Type</h2>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Libellé --}}
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
</div>

                    {{-- Image --}}
                    <div class="mb-4">
                        <label class="form-label fw-medium">Image</label>
                        <input type="file" name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/*"
                               onchange="previewImage(this)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        {{-- Prévisualisation --}}
                        <div class="mt-2" id="preview-container" style="display:none;">
                            <img id="preview-img" src="#" width="100" height="100"
                                 style="object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('types.index') }}" class="btn btn-outline-secondary w-50">Annuler</a>
                        <button type="submit" class="btn btn-primary w-50">💾 Enregistrer</button>
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