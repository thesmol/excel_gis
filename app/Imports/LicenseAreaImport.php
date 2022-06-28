<?php

namespace App\Imports;

use App\Models\license_area;
use Maatwebsite\Excel\Concerns\ToModel;

class LicenseAreaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new license_area([
            //
        ]);
    }
}
