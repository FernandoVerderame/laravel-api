@extends('layouts.app')

@section('title', 'Project')

@section('content')

<header class="border-bottom">
    <h1 class="mt-4 mb-1">{{ $project->title }}</h1>
    <p>Type: @if ($project->type)
        <span class="badge align-middle" style="background-color: {{ $project->type->color }}">{{ $project->type->label }}</span>
        @else
            Nothing
        @endif
    </p>
</header>

<div class="clearfix py-4 border-bottom mb-3">
    @if($project->image)
        <img src="{{ Vite::asset('public/storage/' . $project->image) }}" class="img-fluid" alt="{{ $project->title }}" class="me-2 float-start">
    @endif
    <p>{{ $project->description }}</p>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <strong>Created at:</strong> {{ $project->getFormattedDate('created_at', 'd-m-Y H:i:s') }}
            <strong>Updated at:</strong> {{ $project->getFormattedDate('updated_at', 'd-m-Y H:i:s') }}
        </div>
        <div>
            @forelse ($project->technologies as $technology)
                <span style="color: {{ $technology->color }}" class="mx-3"><i class="{{ $technology->icon }} h2 m-0"></i></span>
            @empty
                Nothing
            @endforelse
        </div>
    </div>
</div>

<footer class="d-flex justify-content-between align-items-center mt-3">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left me-2"></i>Back to projects</a>

    <div class="d-flex justify-content-between gap-2">
        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil me-2"></i>Edit</a>

        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal" data-project="{{ $project->title }}">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can me-2"></i>Delete</button>
        </form>
    </div>
</footer>

@endsection

@section('scripts')
  @vite('resources/js/delete_confirmation.js')
@endsection