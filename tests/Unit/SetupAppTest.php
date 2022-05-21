<?php

namespace Tests\Unit;

use App\Console\Commands\SetupAppCommand;
use App\Console\Commands\SetupTestingCommand;
use PHPUnit\Framework\TestCase;

class SetupAppTest extends TestCase
{

    /** @test */
    public function it_has_setup_app_command()
    {
        $this->assertTrue(class_exists(SetupAppCommand::class));
    }

    /** @test */
    public function it_has_setup_test_command()
    {
        $this->assertTrue(class_exists(SetupTestingCommand::class));
    }

}
