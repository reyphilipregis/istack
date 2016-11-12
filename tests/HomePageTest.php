<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomePageTest extends TestCase
{
     /**
     * Login successfully.
     */
    private function loginSuccessfully()
    {
        $this->visit('/');
        $this->type('reyphilipregis@gmail.com', 'email');
        $this->type('secret', 'password');
        $this->press('Login');
        $this->seePageIs('/home');
    }

    /**
     * Test if PDFun link is clicked in the home page.
     */
    public function testPDFunIsClickedinHomePage()
    {
        $this->loginSuccessfully();
        $this->click('PDFun');
        $this->see('Welcome Rey Philip Regis!');
    }

    /**
     * Test if Home link is clicked in the home page.
     */
    public function testHomeIsClickedinHomePage()
    {
        $this->loginSuccessfully();
        $this->click('Home');
        $this->see('Welcome Rey Philip Regis!');
    }
}
