<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\cFieldExplorationImport;

class FieldExplorationImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:FieldExplorationImport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $import = new cFieldExplorationImport();
        Excel::import($import, 'D:\Personal\excel_gis\app\ias_uvs_summary.xlsx');
    }
}
