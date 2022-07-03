<?php

namespace App\Imports;

use App\Models\authoritie;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class cAuthoritieImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Лицензия' => new SheetImport(),
        ];
    }
}

class SheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row['authoritie']!=null){
                authoritie::firstOrCreate([
                    'authoritie' => $row['authoritie'],
                ]);
            }
        }
    }
}
