<?php

namespace Tests\Feature;

use App\Console\Commands\ImportCustomersCommand;
use Tests\TestCase;

class ImportCustomersTest extends TestCase
{
    /** @test */
    public function it_has_import_customers_command()
    {
        $this->assertTrue(class_exists(ImportCustomersCommand::class));
    }

    /** @test */
    public function it_can_import_customers()
    {
        $this->artisan('import:customers', ['fileName' => 'customer_test.csv'])
            ->expectsOutput('Customers Import is completed')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_skip_invalid_file()
    {
        $this->artisan('import:customers', ['fileName' => 'customer_test.txt'])
            ->expectsOutput("Customers Import failed")
            ->assertExitCode(1);
    }
}
