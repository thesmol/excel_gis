<?php

namespace App\Imports;

use App\Models\field;
use App\Models\field_exploration;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cFieldImport implements WithMultipleSheets
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
    private $field_explorations;

    public function __construct()
    {
        $this -> field_explorations = field_exploration::select('fe_id', 'exploration')->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            $field_explorations = $this->field_explorations->where('exploration', $row['field_exploration'])->first();

            if($row['field']!=null)
                    if(stristr($row['field'], '(', true) == 0){
                        $field = $row['field'];
                    }
                    else{
                        $field = stristr($row['field'], '(', true);
                    }
                {
                    field::Create([
                        'field_name' => $field,
                        'field_explorations_id' => $field_explorations -> fe_id ?? NULL,
                        'coords' => $row['coords'],
                    ]);
                }
        }
    }
}
