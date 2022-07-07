<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\cAuthoritieImport;

class AuthoritieImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AuthoritieImport';

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
        $import = new cAuthoritieImport();
        Excel::import($import, 'D:\Personal\excel_gis\app\ias_uvs_summary.xlsx');
    }
}
