<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupTestingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Application Testing';

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
        if (env('GOOGLE_MAP_API_KEY') == null) {
            $this->warn("Please setup GOOGLE_MAP_API_KEY in your environment variable");
            return;
        }

        Artisan::call('key:generate');

        $this->info("Resetting database table");
        try {
            Artisan::call('migrate:refresh');
        } catch (Exception $e) {
            $this->warn("Please check your database configuration, migration is failing with: " . $e->getMessage());
            return;
        }

        try {
            $this->info("Running database seeder");
            Artisan::call('db:seed');

            $this->info("Installing Laravel Passport");
            Artisan::call('passport:install');

            $this->info("Importing Customers");
            Artisan::call('import:customers customer_test.csv');

        } catch (Exception $e) {
            $this->warn("Setup failed with error " . $e->getMessage());
            return;
        }
        $this->info("Setup was successful");
        return 0;
    }
}
