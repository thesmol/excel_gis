<?php

namespace App\Imports;

use App\Models\la_field;
use Maatwebsite\Excel\Concerns\ToModel;

class LAFieldImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new la_field([
            //
        ]);
    }
}
