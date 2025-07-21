 <table class="table table-striped mb-0">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Period</th>
            <th>Vehicle</th>
            <th>Fuel Type</th>
            <th>Total Fuel (Liters)</th>
            <th>Price / Liter (ETB)</th>
            <th>Total Price (ETB)</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grandTotal = 0;
            $grandETB = 0;
        @endphp
        @forelse($data as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->period }}</td>
                <td>{{ $row->vehicle->name ?? 'N/A' }} ({{ $row->vehicle->registration_number ?? 'N/A' }})</td>
                <td>{{ $row->fuel->name ?? 'N/A' }}</td>
                <td>{{ number_format($row->total_fuel, 2) }}</td>
                <td>{{ number_format($row->price, 2) }}</td>
                <td>{{ number_format($row->total_price, 2) }}</td>
            </tr>
            @php
                $grandTotal += $row->total_fuel;
                $grandETB += $row->total_price;
            @endphp
        @empty
            <tr>
                <td colspan="7" class="text-center">No records found.</td>
            </tr>
        @endforelse
    </tbody>
    @if($grandTotal > 0)
        <tfoot>
            <tr class="fw-bold text-end">
                <td colspan="4">Grand Total (Liters):</td>
                <td>{{ number_format($grandTotal, 2) }}</td>
                <td></td>
                <td>{{ number_format($grandETB, 2) }}</td>
            </tr>
        </tfoot>
    @endif
</table>
