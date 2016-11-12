<?php

use App\Classes\IStackMail;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class IStackMailTest extends TestCase
{
    /**
     * Teardown.
     */
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * Test if Home link is clicked in the home page.
     */
    public function testMock()
    {
        $mock = Mockery::mock('IStackMail');
        $mock->shouldReceive('sendMail')->once()->andReturn(true);

        $data = $mock->sendMail([], 'downloads/test.pdf');

        $this->assertEquals(true, $data);
    }
}
