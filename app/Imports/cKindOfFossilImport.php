<?php

namespace App\Imports;

use App\Models\kind_of_fossil;
use Maatwebsite\Excel\Concerns\ToModel;

class cKindOfFossilImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new kind_of_fossil([
            //
        ]);
    }
}
