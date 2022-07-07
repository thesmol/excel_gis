<?php

namespace App\Imports;

use App\Models\license;
use App\Models\company;
use App\Models\license_area;
use App\Models\license_status;
use App\Models\authoritie;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class cLicenseImport implements WithMultipleSheets
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
    private $companies;
    private $license_areas;
    private $license_statuses;
    private $authorities;

    public function __construct()
    {
        $this -> companies = company::select('c_id', 'company_name')->get();
        $this -> license_areas = license_area::select('la_id', 'licanse_area_name')->get();
        $this -> license_statuses = license_status::select('ls_id', 'status')->get();
        $this -> authorities = authoritie::select('a_id', 'authoritie')->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            if(stristr($row['license_area'], '(', true) == 0){
                $license_area = $row['license_area'];
            }
            else{
                $license_area = stristr($row['license_area'], '(', true);
            }
            $license_area = trim($license_area);
            $companies = $this->companies->where('company_name', $row['company'])->first();
            $license_areas = $this->license_areas->where('licanse_area_name', $license_area)->first();
            $license_statuses = $this->license_statuses->where('status', $row['license_status'])->first();
            $authorities = $this->authorities->where('authoritie', $row['authoritie'])->first();

            dump('=========================');
            dump(trim($row['series']));
            dump(trim($row['number']));
            dump(trim($row['type']));
            dump($companies -> c_id);
            dump($license_areas -> la_id);
            dump($license_statuses -> ls_id ?? null);
            dump($row['target_destination']);
            dump($row['kind_of_fossil']);
            dump($authorities -> a_id ?? null);

            $creationArray=([
                'prev_l_id' => null,
                'l_series' => trim($row['series']),
                'l_number' => trim($row['number']),
                'l_type' => trim($row['type']),
                'company_id' => $companies -> c_id,
                'license_area_id' => $license_areas -> la_id,
                'license_status_id' => $license_statuses -> ls_id ?? null,
                'target_destination' => $row['target_destination'],
                'kind_of_fossil' => $row['kind_of_fossil'],
                'authorities_id' => $authorities -> a_id ?? null,
                'date_of_start' => Date::excelToDateTimeObject($row['date_of_start'])->format('Y-m-d'),
                'date_of_end' => Date::excelToDateTimeObject($row['date_of_end'])->format('Y-m-d'),
                'date_of_annulation' => Date::excelToDateTimeObject($row['date_of_annulation'])->format('Y-m-d'),
                'coords' => $row['coords']
            ]);

            // $validator = Validator::make($creationArray, license::rules());
			// if ($validator->fails()) {
			// 	continue;
			// }

            if($row['company']!=null && $row['license_area']!=null && $row['series']!=null && $row['number']!=null && $row['type']!=null && $row['date_of_start']!=null && $row['date_of_end']!=null)
            {
                license ::FirstOrCreate($creationArray);
            }
        }
        foreach($rows as $row)
        {
            $prev_license = license::select('l_id')
				->where(DB::raw('CONCAT(l_series, l_number, l_type'), $row['prev_license'])
				->value('l_id');

            license::
                where('l_series', trim($row['series']))
                ->where('l_numper', trim($row['number']))
                ->where('l_type', trim($row['type']))
                ->update(['prev_l_id' => $prev_license]);
        }
    }
}
