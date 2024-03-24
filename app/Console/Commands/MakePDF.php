<?php

namespace App\Console\Commands;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;

class MakePDF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = microtime(true);

        $pdf = Pdf::setOptions([
            'isFontSubsettingEnabled' => true,
            'fontDir' => storage_path('fonts'),
            'fontCache' => storage_path('fonts'),
            'enable_php' => true,
        ]);
        $pdf->loadView('pdf.report');
        // $pdf->loadView('pdf.invoice');
        // $pdf->loadView('pdf.table');
        $pdf->save(public_path('archives/report.pdf'));
        // $pdf->save(public_path('archives/invoice.pdf'));
        // $pdf->save(public_path('archives/table.pdf'));

        $end = microtime(true);
        $time = $end - $start;
        $this->info("$time");

        return 0;
    }
}
