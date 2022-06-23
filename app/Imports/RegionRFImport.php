<?php

namespace App\Imports;

use App\Models\region_rf;
use Maatwebsite\Excel\Concerns\ToModel;

class RegionRFImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new region_rf([
            //
        ]);
    }
}
