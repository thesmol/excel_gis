<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TargetDestinationImport;

// spl_autoload_register(function ($class_name) {
//     include $class_name . '.php';
// });

class KindOfFossilImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:KindOfFossilImport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import model KindOfFossil from the excel file ias_uvs_summary';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $import = new TargetDestinationImport();
        //$import->onlySheets('Лицензия');

        try
            {
                Excel::import($import, 'D:\Personal\excel_gis\app\ias_uvs_summary.xlsx');
            }
        catch (\Maatwebsite\Excel\Validators\ValidationException $e)
            {
                $failures = $e->failures();
                return view('welcome', compact('failures'));
            }
    }
}
