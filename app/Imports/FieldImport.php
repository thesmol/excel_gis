<?php

namespace App\Imports;

use App\Models\field;
use Maatwebsite\Excel\Concerns\ToModel;

class FieldImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new field([
            //
        ]);
    }
}
