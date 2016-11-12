<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginPageTest extends TestCase
{
    /**
     * Test Login page is working correctly.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->visit('/')
             ->see('PDFun')
             ->see('Login');
    }

    /**
     * Test if Home link is clicked.
     */
    public function testHomeLinkClicked()
    {
        $this->visit('/');
        $this->click('Home');
        $this->see('Login');
    }

    /**
     * Test if PDFun link is clicked.
     */
    public function testHelpdeskIsIntelligent()
    {
        $this->visit('/');
        $this->click('PDFun');
        $this->see('Login');
    }

    /**
     * Test if user logged correcly.
     */
    public function testCorrectCredentials()
    {
        $this->visit('/');
        $this->type('reyphilipregis@gmail.com', 'email');
        $this->type('secret', 'password');
        $this->press('Login');
        $this->seePageIs('/home');
        $this->see('Welcome Rey Philip Regis!');
    }

    /**
     * Test if user typed wrong password.
     */
    public function testWrongCredentials()
    {
        $this->visit('/');
        $this->type('reyphilipregis@gmail.com', 'email');
        $this->type('wrongpassword', 'password');
        $this->press('Login');
        $this->seePageIs('/');
        $this->see('These credentials do not match our records.');
    }

    /**
     * Test if no email and password logging in.
     */
    public function testNoEmailAndPassword()
    {
        $this->visit('/');
        $this->press('Login');
        $this->seePageIs('/');
        $this->see('The email field is required.');
        $this->see('The password field is required.');
    }

    /**
     * Test if no password logging in.
     */
    public function testNoPassword()
    {
        $this->visit('/');
        $this->type('reyphilipregis@gmail.com', 'email');
        $this->press('Login');
        $this->seePageIs('/');
        $this->see('The password field is required.');
    }

    /**
     * Test if no email logging in.
     */
    public function testNoEmail()
    {
        $this->visit('/');
        $this->type('secret', 'password');
        $this->press('Login');
        $this->seePageIs('/');
        $this->see('The email field is required.');
    }

    /**
     * Test Logout functionaliry.
     */
    public function testLogout()
    {
        $this->visit('/');
        $this->type('reyphilipregis@gmail.com', 'email');
        $this->type('secret', 'password');
        $this->press('Login');
        $this->seePageIs('/home');
        $this->click('Rey Philip Regis');
        $this->click('Logout');
        $this->seePageIs('/');
        $this->see('Login');
    }
}
