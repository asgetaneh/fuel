<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class FuelEfficiencyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $report;

    public function __construct(Collection $report)
    {
        $this->report = $report;
    }
    public function collection()
    {
        return $this->report->map(function ($row) {
            return [
                $row['vehicle'],
                $row['expected_km_per_l'],
                $row['actual_km_per_l'],
                $row['variance'],
                $row['total_km'],
                $row['total_fuel'],
            ];
        });
    }
     public function headings(): array
    {
        return ['Vehicle', 'Expected KM/L', 'Actual KM/L', 'Variance', 'KM Covered', 'Fuel Used (L)'];
    }
}
