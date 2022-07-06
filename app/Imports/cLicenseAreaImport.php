<?php

namespace App\Imports;

use App\Models\license_area;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cLicenseAreaImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Лицензионный_участок' => new SheetImport(),
        ];
    }
}


class SheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            if($row['license_area']!=null)
                {
                    if(stristr($row['license_area'], '(', true) == 0){
                        $license_area = $row['license_area'];
                    }
                    else{
                        $license_area = stristr($row['license_area'], '(', true);
                    }

                    license_area::FirstOrCreate([
                        'licanse_area_name' => $license_area,
                    ]);
                }
        }
    }
}
