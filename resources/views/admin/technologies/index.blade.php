@extends('layouts.app')

@section('title', 'Technologies')

@section('content')

<header class="d-flex align-items-center justify-content-between pb-4 mb-4 mt-3 border-bottom">
    <h1>Technologies</h1>
</header>

<table class="table table-hover table-secondary table-striped border mb-4">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Label</th>
            <th scope="col">Icon</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.technologies.create') }}" class="btn btn-sm btn-success"><i class="fa-solid fa-plus me-2"></i>New Technology</a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>

        @forelse($technologies as $technology)
        <tr>
            <th scope="row">{{ $technology->id }}</th>
            <td>
                <span class="badge rounded-pill align-middle" style="background-color: {{ $technology->color }}">{{ $technology->label }}</span>
            </td>
            <td>
                <span class="badge rounded-pill align-middle" style="color: {{ $technology->color }}"><i class="{{ $technology->icon }} h3 m-0"></i></span>
            </td>
            <td>{{ $technology->getFormattedDate('created_at') }}</td>
            <td>{{ $technology->getFormattedDate('updated_at') }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                    </a>

                    <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal" data-project="{{ $technology->title }}">
                        @csrf
                        @method('DELETE')
                    <button technology="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </div>
            </td>
        </tr>

        @empty 
            <tr>
                <td colspan="6">
                    <h3 class="text-center">There aren't any technologies.</h3>
                </td>
            </tr>
        @endforelse

    </tbody>
</table>

@endsection

@section('scripts')
  @vite('resources/js/delete_confirmation.js')
@endsection