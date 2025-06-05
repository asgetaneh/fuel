@extends('layouts.myapp')

@section('title', 'Station Fuel Stored Page')

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
                                <div class="col-sm-6"><h3 class="card-title">Station Fuel Stored List</h3></div>
                                <div class="col-sm-6 card-title text-end">
                                    <a href="{{ route('station-fuel-storeds.create') }}" class="btn btn-primary">
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
                                        <th>Station</th>
                                        <th>Fuel</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Received By</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stationFuelStored as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->station->name ?? 'N/A' }}</td>
                                            <td>{{ $item->fuel->name ?? 'N/A' }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->date)->format('Y-m-d') }}</td>
                                            <td>{{ $item->received_by }}</td>
                                            <td>{{ $item->notes }}</td>
                                            <td>
                                                <a href="{{ route('station-fuel-storeds.show', $item->id) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('station-fuel-storeds.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('station-fuel-storeds.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                            <td colspan="8" class="text-center">No station fuel records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $stationFuelStored->links() }}
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
