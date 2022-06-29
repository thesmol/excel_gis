<?php

namespace App\Imports;

use App\Models\target_destination;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class cTargetDestinationImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Лицензия' => new SheetImport(),
        ];
    }
}

class SheetImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Validator::make($rows->toArray(), [
        //     '*.0' => 'required',
        // ])->validate();

        foreach($rows as $row) {
            if($row[6]!=null){
                target_destination::create([
                    'target' => $row[6],
                ]);
            }
        }
    }
}
// class SheetImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */

//     use Importable;

//     public function model(array $row)
//     {
//         // $target_destinations = target_destination::firstOrCreate([
//         //     'target' => $row['target_destination']
//         // ]);
//         dd($row);
//         return new target_destination([
//             'target' => $row['target_destination']
//         ]);
//     }

//     public function chunkSize(): int
//     {
//         return 1000;
//     }

//     public function rules(): array
//     {
//         return [
//             'target' => Rule::unique('target_destination', 'target'),
//             'target' => [
//                 'required',
//                 'string',
//             ]
//         ];
//     }

//     public function customValidationMessages()
//     {
//         return [
//             'target.unique' => 'Duplicate',
//         ];
//     }
// }
