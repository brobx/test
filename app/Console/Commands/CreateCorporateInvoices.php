<?php

namespace App\Console\Commands;

use App\Billing\BillingManager;
use Illuminate\Console\Command;

class CreateCorporateInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Monthly Invoices for the current month for all corporates.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        BillingManager::billCorporatesForThisMonth();
    }
}
