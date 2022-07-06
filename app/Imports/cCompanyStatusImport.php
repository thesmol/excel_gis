<?php

namespace App\Imports;

use App\Models\company_status;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cCompanyStatusImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Недропользователь(компания)' => new SheetImport(),
        ];
    }
}

class SheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row['company_status']!=null){
                company_status::firstOrCreate([
                    'status' => $row['company_status'],
                ]);
            }
        }
    }
}
