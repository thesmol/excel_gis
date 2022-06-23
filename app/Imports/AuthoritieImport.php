<?php

namespace App\Imports;

use App\Models\authoritie;
use Maatwebsite\Excel\Concerns\ToModel;

class AuthoritieImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new authoritie([
            //
        ]);
    }
}
