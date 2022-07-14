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
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;



class cLicenseImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Лицензия' => new SheetImport(),
        ];
    }
}

class SheetImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    private $companies;
    private $license_areas;
    private $license_statuses;
    private $authorities;

    public function chunkSize(): int
    {
        return 5000;
    }

    public function __construct()
    {
        $this -> companies = company::select('c_id', 'company_name')->get();
        $this -> license_areas = license_area::select('la_id', 'licanse_area_name')->get();
        $this -> license_statuses = license_status::select('ls_id', 'status')->get();
        $this -> authorities = authoritie::select('a_id', 'authoritie')->get();
    }

    public function collection(Collection $rows)
    {
        ini_set('memory_limit', '200M');
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

            if(($companies -> c_id ?? null) != null && ($license_areas -> la_id ?? null) !=null){
                $creationArray=([
                'prev_l_id' => null,
                'l_series' => trim($row['series']),
                'l_number' => trim($row['number']),
                'l_type' => trim($row['type']),
                'company_id' => $companies -> c_id,
                'license_area_id' => $license_areas -> la_id,
                'license_status_id' => $license_statuses -> ls_id ?? null,
                'target_destination' => trim($row['target_destination']),
                'kind_of_fossil' => trim($row['kind_of_fossil']),
                'authorities_id' => $authorities -> a_id ?? null,
                'date_of_start' => Date::excelToDateTimeObject($row['date_of_start'])->format('Y-m-d'),
                'date_of_end' => Date::excelToDateTimeObject($row['date_of_end'])->format('Y-m-d'),
                'date_of_annulation' => Date::excelToDateTimeObject($row['date_of_annulation'])->format('Y-m-d'),
                'coords' => trim($row['coords'])
                ]);
            }
            license ::FirstOrCreate($creationArray);

        }

        foreach($rows as $row)
        {
            $prev_license = DB::table('licenses')
				->select('l_id')
				->where(DB::raw('CONCAT(l_series, l_number, l_type)'), '=', trim($row['prev_license']))
				->get();

			if (count($prev_license) == 0) continue;
			$prev_license = $prev_license[0]->l_id;

            License::where('l_series', '=', trim($row['series']))
                ->where('l_number', '=', trim($row['number']))
                ->where('l_type', '=', trim($row['type']))
                ->update(['prev_l_id' => $prev_license]);
        }
    }
}
