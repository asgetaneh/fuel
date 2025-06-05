@extends('layouts.myapp')

@section('title', 'Fuel Requests Page')

@section('content')
<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header"></div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Fuel Request List</h3>
                                </div>
                                <div class="col-sm-6 card-title text-end">
                                    <a href="{{ route('fuel-requests.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i> Create New
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vehicle</th>
                                        <th>Fuel</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Station</th>
                                        <th>Reason</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($requests as $request)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $request->vehicle->name ?? '-' }}</td>
                                            <td>{{ $request->fuel->name ?? '-' }}</td>
                                            <td>{{ $request->amount }}</td>
                                            <td>{{ $request->date }}</td>
                                            <td>{{ $request->station->name ?? '-' }}</td>
                                            <td>{{ $request->serviceReason->name ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('fuel-requests.show', $request->id) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('fuel-requests.edit', $request->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('fuel-requests.destroy', $request->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No fuel requests found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

</main>
<!--end::App Main-->
@endsection
