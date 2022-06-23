<?php

namespace App\Imports;

use App\Models\license_status;
use Maatwebsite\Excel\Concerns\ToModel;

class LicenseStatusImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new license_status([
            //
        ]);
    }
}
