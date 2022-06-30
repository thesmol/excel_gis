<?php

namespace App\Imports;

use App\Models\company_status;
use Maatwebsite\Excel\Concerns\ToModel;

class cCompanyStatusImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new company_status([
            //
        ]);
    }
}
