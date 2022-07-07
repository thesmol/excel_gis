<?php

namespace App\Imports;

use App\Models\license_area;
use App\Models\field;
use App\Models\la_field;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cLAFieldImport implements WithMultipleSheets
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
    private $license_areas;

    public function __construct()
    {
        ini_set('memory_limit', '200M');
        $this-> fields = field::select('f_id', 'field_name')
            ->get();
        $this-> license_areas = license_area::select('la_id','licanse_area_name')
            ->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row['field']!=null and $row['license_areas']!=null)
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


                foreach(explode('\n', $row['license_areas']) as $licanse_area_name)
                {
                    if ($licanse_area_name = '') break;

                    if(stristr($row['license_areas'], '(', true) == 0){
                        $licanse_area_name = $row['license_areas'];
                    }
                    else{
                        $licanse_area_name = stristr($row['license_areas'], '(', true);
                    }

                    $licanse_area_name = trim($licanse_area_name);

                    $license_areas = $this
                    ->license_areas->where('licanse_area_name', $licanse_area_name)
                    ->first();

                    dump($field);
                    dump($fields -> f_id);

                    dump($licanse_area_name);
                    dump($license_areas -> la_id);

                    la_field::FirstOrCreate([
                    'license_areas_id' => $license_areas -> la_id,
                    'fields_id' => $fields -> f_id,
                    ]);
                }

            }
        }
    }
}
