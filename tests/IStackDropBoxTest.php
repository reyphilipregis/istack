<?php

use App\Classes\IStackDropBox;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class IStackDropBoxTest extends TestCase
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
        $expectedReturn = [
            'share' => 'test_share',
            'view'  => 'test_view'
        ];

        $mock = Mockery::mock('IStackDropBox');
        $mock->shouldReceive('upload')->once()->andReturn($expectedReturn);

        $data = $mock->upload(['test']);

        $this->assertEquals($expectedReturn, $data);
    }
}
