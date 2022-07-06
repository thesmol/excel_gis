<?php

namespace App\Imports;

use App\Models\field_exploration;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cFieldExplorationImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Месторождение' => new SheetImport(),
        ];
    }
}

class SheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row['field_exploration']!=null){
                field_exploration::firstOrCreate([
                    'exploration' => $row['field_exploration'],
                ]);
            }
        }
    }
}
