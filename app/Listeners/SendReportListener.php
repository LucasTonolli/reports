<?php

namespace App\Listeners;

use App\Events\ReportGenerated;
use App\Mail\ReportGeneratedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendReportListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReportGenerated $event): void
    {
        logger("SendReportListener");
        Mail::to('dev@dev.com')
            ->send(new ReportGeneratedEmail($event->fileName));
    }
}
