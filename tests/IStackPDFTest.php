<?php

use App\Classes\IStackPDF;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class IStackPDFTest extends TestCase
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
            'full_path_filename' => 'downloads/test.pdf',
            'filename'           => 'test.pdf'
        ];

        $mock = Mockery::mock('IStackPDF');
        $mock->shouldReceive('generatePDF')->once()->andReturn($expectedReturn);

        $data = $mock->generatePDF();

        $this->assertEquals($expectedReturn, $data);
    }
}
