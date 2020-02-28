<?php

namespace Tests\Unit;

use Tests\TestCase;

/**
 * Test for correctly displaying view of CurrencyCalc
 *
 * @group Frontend
 */
class CurrencyCalcPageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        $this->get('/')
            ->assertOk()
            ->assertSeeInOrder([
                'Currencies Converter',
                'Calculate Currencies',
            ]);
    }
}
