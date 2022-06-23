<?php

namespace App\Imports;

use App\Models\target_destination;
use Maatwebsite\Excel\Concerns\ToModel;

class TargetDestinationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new target_destination([
            //
        ]);
    }
}
