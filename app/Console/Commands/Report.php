<?php

namespace App\Console\Commands;

use App\Exports\ReportExport;
use App\Jobs\GenerateReport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report {startDate} {endDate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate report from start date to end date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');

        GenerateReport::dispatchSync($startDate, $endDate);
        // dispatch(new GenerateReport($startDate, $endDate));

        return Command::SUCCESS;
    }
}
