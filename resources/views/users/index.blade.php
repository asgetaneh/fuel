@extends('layouts.myapp')

@section('title', 'User Role Management')

@section('content')
<div class="container mt-4">
    <h2>User Role Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Current Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge bg-primary">{{ $role->name }}</span>
                            <form method="POST" action="{{ route('users.removeRole', ['user' => $user->id, 'role' => $role->id]) }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <span class="badge bg-primary">
                                    {{ $role->name }}
                                    <button type="submit" class="btn btn-sm btn-danger btn-close ms-1" title="Remove Role"
                                        onclick="return confirm('Remove role {{ $role->name }} from {{ $user->name }}?')">
                                    </button>
                                </span>
                            </form>
                        @endforeach
                    </td>
                    <td>
                        <!-- Trigger the form modal -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#assignRoleModal{{ $user->id }}">
                            Assign Role
                        </button>



                        <!-- Modal -->
                        <div class="modal fade" id="assignRoleModal{{ $user->id }}" tabindex="-1" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <form method="POST" action="{{ route('users.assignRole', $user->id) }}">
                                @csrf
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Assign Role to {{ $user->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Select Role</label>
                                        <select name="role" class="form-select" required>
                                            <option value="">-- Select Role --</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Assign</button>
                                  </div>
                                </div>
                            </form>
                          </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
