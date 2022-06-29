<?php

namespace App\Imports;

use App\Models\regions_field;
use Maatwebsite\Excel\Concerns\ToModel;

class cRegionsFieldImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new regions_field([
            //
        ]);
    }
}
