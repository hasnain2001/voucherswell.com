@extends('admin.layouts.app')
@section('title', 'Language Management')

@section('content')
@include('components.admin.page-header', [
    'title' => 'Language Management',
    'breadcrumbs' => [
        'Ubold' => route('admin.dashboard'),
        'Languages' => 'active'
    ]
])

<div class="card shadow-sm">
    <div class="card-body">
        {{-- ✅ Create Language Form --}}
    <form name="Createlanguage" id="Createlanguage" method="POST" action="{{ route('admin.language.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Language Name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name="code" placeholder="Language Code" required>
                </div>
                <div class="col-md-2 mb-3">
                    <select class="form-control" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <input type="file" class="form-control" name="flag" accept="image/*" required>
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </div>
            </div>
        </form>

        <hr>

        {{-- ✅ Language Table --}}
        <table id="datatable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>flag</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($languages as $language)
                    <tr id="row-{{ $language->id }}">
                        <td>{{ $language->name }}</td>
                        <td>{{ $language->code }}</td>
                        <td>
                            <img src="{{ Storage::disk('public')->url($language->flag) }}"
                                 alt="{{ $language->name }}"
                                 width="60"
                                 class="rounded border">
                        </td>
                        <td>
                            <span class="badge {{ $language->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $language->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.language.edit', $language->id) }}" class="btn btn-sm btn-primary edit-btn">Edit</a>

                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $language->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

