@extends('layouts.myapp')

@section('title', 'Create Office')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-4">
                    <div class="card-header"><h3 class="card-title">Create Office</h3></div>
                    <div class="card-body">
                        <form action="{{ route('offices.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Parent Office</label>
                                <select name="parent_office_id" class="form-control">
                                    <option value="">-- Select Parent Office --</option>
                                    @foreach($parentOffices as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Manager</label>
                                <select name="manager_id" class="form-control">
                                    <option value="">-- Select Manager --</option>
                                    @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                                <a href="{{ route('offices.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
