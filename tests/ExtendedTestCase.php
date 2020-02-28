<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Helper class.
 * Correct setup database before tests.
 */
class ExtendedTestCase extends TestCase
{
    use DatabaseMigrations;

    /**
     * Overwrite setUp() method.
     */
    public function setUp(): void
    {
        parent::setUp();

        if (DB::connection() instanceof \Illuminate\Database\SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=1'));
        }
/*
        if (config('database.default') === 'sqlite'){
            $db = app()->make('db');
            $db->connection()->getPdo()->exec('PRAGMA foreign_keys=1');
            //Schema::enableForeignKeyConstraints();
        }
*/        
        $this->artisan('migrate');
        $this->artisan('db:seed');
    }
}
