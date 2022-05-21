<?php

namespace App\Console\Commands;

use App\Services\CustomerService;
use Exception;
use Illuminate\Console\Command;

class ImportCustomersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers {fileName=customer.csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Customers From CSV';

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
     * Import customers from csv
     *
     * @param CustomerService $customerService
     * @return int
     * @throws Exception
     */
    public function handle(CustomerService $customerService)
    {
        $fileName = $this->argument('fileName');

        try {
        $statistics = (object)$customerService::importCustomersFromCSV($fileName);

        $this->line("Customers Import is completed");
        $this->info("Created $statistics->newlyCreated customer(s)\nPrevious created $statistics->previouslyCreated customers");
        return 0;
      } catch(\Exception $e) {
        $this->line("Customers Import failed");
        $this->warn($e->getMessage());
        return 1;
      }
    }
}
