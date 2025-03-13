<?php

namespace App\Jobs;

use App\Console\Commands\Report;
use App\Events\ReportGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class GenerateReport implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $startDate, public string $endDate)
    {
        logger("GenerateReport");
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = "users_report_{$this->startDate}_{$this->endDate}_" . now()->timestamp . ".xlsx";
        logger($fileName);
        Excel::store(new ReportExport($this->startDate, $this->endDate), $fileName);

        event(new ReportGenerated($fileName));
    }
}
