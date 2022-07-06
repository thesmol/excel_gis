<?php

namespace App\Imports;

use App\Models\district_rf;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cDistrictRFImport implements WithMultipleSheets
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
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row['district_rf']!=null){
                district_rf::firstOrCreate([
                    'district' => $row['district_rf'],
                ]);
            }
        }
    }
}
