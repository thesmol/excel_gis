<?php

namespace App\Imports;

use App\Models\company;
use App\Models\company_status;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class cCompanyImport implements WithMultipleSheets
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
    private $company_statuses;

    public function __construct()
    {
        $this -> company_statuses = company_status::select('cs_id', 'status')->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            $company_statuses = $this->company_statuses->where('status', $row['company_status'])->first();

            if($row['name']!=null)
            {
                company::FirstOrCreate([
                    'company_name' => $row['name'],
                    'mc_id' => NULL,
                    'company_status_id' => $company_statuses -> cs_id ?? NULL,
                    'address' => $row['address'],
                    'inn' => $row['inn'],
                    'code_OKPO' => $row['okpo'],
                    'code_OKATO' => $row['okato'],
                    'OGRN' => $row['ogrn'],
                    'comment' => $row['comment'],
                ]);
            }
        }

        foreach($rows as $row)
        {
            $management_company = company::select('c_id')
				->where('company_name', trim($row['mother_company']))
				->value('c_id');
            if(trim($row['mother_company'])==null || trim($row['mother_company'])=='Самостоятельные') continue;

            company::where('company_name', trim($row['name']))->update(['mc_id' => $management_company]);
        }

        // foreach($rows as $row)
        // {
        //     if($row['mother_company'] != 'Самостоятельные' && $row['mother_company'] != NULL)
        //     {
        //         company::FirstOrCreate([
        //             'company_name' => $row['mother_company'],
        //         ]);
        //     }
        // }

    }
}
