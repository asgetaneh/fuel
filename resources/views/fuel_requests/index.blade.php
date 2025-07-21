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
                                    <h3 class="card-title">Fuel Distrubition List</h3>
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
                                        <th>KM Covered</th>
                                        <th>Fuel</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        {{-- <th>Station</th> --}}
                                        <th>Reason</th>
                                        <th>Reason Explanation</th>
                                        <th>Submited By</th>
                                        {{-- <th>Approved By</th>
                                        <th>Status</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($requests as $request)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{-- {{ $request->vehicle->name ?? '-' }} --}}
                                                {{ $request->vehicle->registration_number }} {{"("}}{{$request->vehicle->name ?? '-' }}{{")"}}
                                            </td>
                                            <td>{{ $request->total_km_covered_by_vehicle ?? '-' }}</td>

                                            <td>{{ $request->fuel->name ?? '-' }}</td>
                                            <td>{{ $request->amount }}</td>
                                            <td>{{ $request->updated_at }}</td>
                                            {{-- <td>{{ $request->station->name ?? '-' }}</td> --}}
                                            <td>{{ $request->serviceReason->name ?? '-' }}</td>
                                            <td>{{ $request->notes ?? '-' }}</td>
                                            <td>{{ $request->requester->name ?? '-' }}</td>
                                            {{-- <td>{{ $request->approver->name ?? '-' }}</td> --}}
                                            {{-- <td>
                                                @if($condition = $request->status === 1)
                                                    <span class="badge bg-success">{{ "Approved" }}</span>
                                                @elseif($condition = $request->status === 0)
                                                    <span class="badge bg-primary">{{ "Requested" }}</span>
                                                @elseif($condition = $request->status === 2)
                                                    <span class="badge bg-danger">{{ "Rejected" }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ "Unknown" }}</span>
                                                @endif
                                                {{-- {{ $request->status }} --}
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('fuel-requests.show', $request->id) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('fuel-requests.edit', $request->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                {{-- <form action="{{ route('fuel-requests.reject', $request->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to reject?')">
                                                    @csrf
                                                    @method('reject')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="reject">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('fuel-requests.approve', $request->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to want to approve?')">
                                                    @csrf
                                                     <button type="submit" class="btn btn-sm btn-primary" title="Approved">
                                                       <i class="fa fa-check" aria-hidden="true"></i>
                                                    </button>
                                                </form> --}}
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
