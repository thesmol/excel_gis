<?php

namespace App\Imports;

use App\Models\field_exploration;
use Maatwebsite\Excel\Concerns\ToModel;

class cFieldExplorationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new field_exploration([
            //
        ]);
    }
}
