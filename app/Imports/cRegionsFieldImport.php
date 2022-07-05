<?php

namespace App\Imports;

use App\Models\regions_field;
use App\Models\region_rf;
use App\Models\field;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cRegionsFieldImport implements WithMultipleSheets
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
    private $region_rves;
    private $fields;

    public function __construct()
    {
        $this -> region_rves = region_rf::select('rr_id', 'region_name')->get();
        $this -> fields = field::select('f_id', 'field_name')->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {

            if($row['field']!=null)
            {
                if(stristr($row['field'], '(', true) == 0){
                    $field = $row['field'];
                }
                else{
                    $field = stristr($row['field'], '(', true);
                }
            }

            $fields = $this->fields->where('field_name', $field)->first();
            $region_rves = $this->region_rves->where('region_name', $row['regionRF'])->first();


            if($row['regionRF']!=null)
                {
                    regions_field::Create([
                        'fields_id' => $fields -> f_id,
                        'region_rves_id' => $region_rves -> rr_id,
                    ]);
                }
        }
    }
}
