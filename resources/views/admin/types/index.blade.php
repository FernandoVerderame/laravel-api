@extends('layouts.app')

@section('title', 'Types')

@section('content')

<header class="d-flex align-items-center justify-content-between pb-4 mb-4 mt-3 border-bottom">
    <h1>Types</h1>
</header>

<table class="table table-hover table-secondary table-striped border mb-4">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Label</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.types.create') }}" class="btn btn-sm btn-success"><i class="fa-solid fa-plus me-2"></i>New Type</a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>

        @forelse($types as $type)
        <tr>
            <th scope="row">{{ $type->id }}</th>
            <td>
                <span class="badge align-middle" style="background-color: {{ $type->color }}">{{ $type->label }}</span>
            </td>
            <td>{{ $type->getFormattedDate('created_at') }}</td>
            <td>{{ $type->getFormattedDate('updated_at') }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                    </a>

                    <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal" data-project="{{ $type->title }}">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </div>
            </td>
        </tr>

        @empty 
            <tr>
                <td colspan="5">
                    <h3 class="text-center">There aren't any types.</h3>
                </td>
            </tr>
        @endforelse

    </tbody>
</table>

@endsection

@section('scripts')
  @vite('resources/js/delete_confirmation.js')
@endsection