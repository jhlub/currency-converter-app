<?php

namespace Tests\Unit;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ExtendedTestCase;

/**
 * Tests for Currency model.
 *
 * @group DBTest
 */
class CurrencyTest extends ExtendedTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSeededTwoCurrencies()
    {
        $this->assertEquals(2, Currency::count());
    }
}
