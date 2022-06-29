<?php

namespace App\Imports;

use App\Models\district_rf;
use Maatwebsite\Excel\Concerns\ToModel;

class cDistrictRFImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new district_rf([
            //
        ]);
    }
}
