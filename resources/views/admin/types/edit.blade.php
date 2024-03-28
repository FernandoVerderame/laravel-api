@extends('layouts.app')

@section('title', 'Edit Type')

@section('content')

<header class="pb-4 mb-4 mt-3 border-bottom">
    <h1>Edit Type</h1>
</header>

<form action="{{ route('admin.types.update', $type->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col">
            <div class="mb-4">
                <label for="label" class="form-label h4">Label</label>
                <input type="text" name="label" id="label" class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid @enderror" placeholder="Label..." value="{{ old('label', $type->label) }}" required>
                @error('label')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else 
                    <div class="form-text">
                        Add type's label
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-2">
            <div class="mb-4">
                <label for="color" class="form-label h4">Color</label>
                <input type="color" name="color" id="color" class="form-control @error('color') is-invalid @elseif(old('color', '')) is-valid @enderror" placeholder="Color..." value="{{ old('color', $type->color) }}">
                @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else 
                    <div class="form-text">
                        Choose type's color
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <footer class="d-flex justify-content-between align-items-center pt-4 border-top">
        <a href="{{ route('admin.types.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left me-2"></i>Back to types</a>
    
        <div>
            <button type="reset" class="btn btn-primary me-2"><i class="fa-solid fa-eraser me-2"></i>Reset</button>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Save</button>
        </div>
    </footer>
    
</form>

@endsection