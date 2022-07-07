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
    private $fields;

    public function __construct()
    {
        ini_set('memory_limit', '200M');
        $this
            -> fields = field::select('f_id', 'field_name')
            ->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row['region_rf']!=null and $row['field']!=null and $row['region_rf']!='Субъект не указан')
            {
                if(stristr($row['field'], '(', true) == 0){
                    $field = $row['field'];
                }
                else{
                    $field = stristr($row['field'], '(', true);
                }
                $field = trim($field);

                $fields = $this
                    ->fields->where('field_name', $field)
                    ->first();

                $region_rves = region_rf::select('rr_id', 'region_name', 'region_short_name')
                    ->where('region_name', $row['region_rf'])
                    ->orWhere('region_short_name', $row['region_rf'])
                    ->first();

                regions_field::FirstOrCreate([
                    'region_rves_id' => $region_rves -> rr_id,
                    'fields_id' => $fields -> f_id,
                ]);
            }
        }
    }
}
