<?php

namespace App\Imports;

use App\Models\district_rf;
use App\Models\region_rf;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cRegionRFImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'СубъектРФ' => new SheetImport(),
        ];
    }
}

class SheetImport implements ToCollection, WithHeadingRow
{
    private $region_rves;

    public function __construct()
    {
        $this -> region_rves = district_rf::select('dr_id', 'district')->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            $region_rves = $this->region_rves->where('district', $row['district_rf'])->first();
            if($row['region_name']!=null)
                {
                    region_rf::Create([
                        'region_name' => $row['region_name'],
                        'region_short_name' => $row['region_short_name'],
                        'district_rves_id' => $region_rves -> dr_id,
                    ]);
                }
        }
    }
}
