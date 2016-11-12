<?php

use App\Template;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TemplateCRUDTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Login successfully.
     */
    private function getFirstTemplateId()
    {
        return Template::first()->id;
    }

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
     * Visit Create Page.
     */
    public function testVisitCreateTemplatePage()
    {
        $this->loginSuccessfully();
        $this->click('Create New Template');
        $this->seePageIs('/template/create');
        $this->see('Create New Template');
    }

    /**
     * No name and message typed.
     */
    public function testNoNameAndMessageDuringCreateTemplateCreation()
    {
        $this->loginSuccessfully();
        $this->click('Create New Template');
        $this->seePageIs('/template/create');
        $this->see('Create New Template');
        $this->press('Create');
        $this->seePageIs('/template/create');
        $this->see('The name field is required.');
        $this->see('The message field is required.');
    }

    /**
     * No message typed during create template.
     */
    public function testNoMessageDuringCreateTemplateCreation()
    {
        $this->loginSuccessfully();
        $this->click('Create New Template');
        $this->seePageIs('/template/create');
        $this->type('Test Template', 'name');
        $this->see('Create New Template');
        $this->press('Create');
        $this->seePageIs('/template/create');
        $this->see('The message field is required.');
    }

    /**
     * No name typed during create template.
     */
    public function testNoNameDuringCreateTemplateCreation()
    {
        $this->loginSuccessfully();
        $this->click('Create New Template');
        $this->seePageIs('/template/create');
        $this->type('Test Message', 'message');
        $this->see('Create New Template');
        $this->press('Create');
        $this->seePageIs('/template/create');
        $this->see('The name field is required.');
    }

    /**
     * Successful template creation.
     */
    public function testSuccessfulTemplateCreation()
    {
        $this->loginSuccessfully();
        $this->click('Create New Template');
        $this->visit('/template/create');
        $this->type('Test Template', 'name');
        $this->type('Test Message', 'message');
        $this->press('Create');
        $this->seePageIs('/template');
        $this->see('Template created successfully');
    }

    /**
     * Visit Edit Page.
     */
    public function testVisitEditTemplatePage()
    {
        $this->loginSuccessfully();
        $this->visit('/template/'.$this->getFirstTemplateId().'/edit');
        $this->see('Edit Template');
    }

    /**
     * Edit successful.
     */
    public function testEditSuccessful()
    {
        $this->loginSuccessfully();
        $this->visit('/template/'.$this->getFirstTemplateId().'/edit');
        $this->see('Edit Template');
        $this->type('Test Template v1', 'name');
        $this->type('Test Message v1', 'message');
        $this->press('Edit');
        $this->seePageIs('/template');
        $this->see('Template updated successfully');
    }

    /**
     * No name and message for editing
     */
    public function testEditNoNameAndMessage()
    {
        $this->loginSuccessfully();
        $this->visit('/template/'.$this->getFirstTemplateId().'/edit');
        $this->type('', 'name');
        $this->type('', 'message');
        $this->press('Edit');
        $this->seePageIs('/template/'.$this->getFirstTemplateId().'/edit');
        $this->see('The name field is required.');
        $this->see('The message field is required.');
    }

    /**
     * No name for editing
     */
    public function testEditNoName()
    {
        $this->loginSuccessfully();
        $this->visit('/template/'.$this->getFirstTemplateId().'/edit');
        $this->type('', 'name');
        $this->press('Edit');
        $this->seePageIs('/template/'.$this->getFirstTemplateId().'/edit');
        $this->see('The name field is required.');
    }

    /**
     * No name and message for editing
     */
    public function testEditNoMessage()
    {
        $this->loginSuccessfully();
        $this->visit('/template/'.$this->getFirstTemplateId().'/edit');
        $this->type('', 'message');
        $this->press('Edit');
        $this->seePageIs('/template/'.$this->getFirstTemplateId().'/edit');
        $this->see('The message field is required.');
    }

    /**
     * Test visitting view page
     */
    public function testView()
    {
        $this->loginSuccessfully();
        $this->visit('/template/'.$this->getFirstTemplateId());
        $this->see('View Template');
    }

    /**
     * Delete template
     */
    public function testDelete()
    {
        $this->loginSuccessfully();
        $this->press('delete');
        $this->seePageIs('/template');
        $this->see('Template deleted successfully');
    }

    /**
     * Test generate page
     */
    public function testGeneratePage()
    {
        $this->loginSuccessfully();
        $this->visit('/template/generate/'.$this->getFirstTemplateId());
        $this->see('Generate PDF Template');
    }

    /**
     * Generete email validation
     */
    public function testGenerateEmailValidation()
    {
        $this->loginSuccessfully();
        $this->visit('/template/generate/'.$this->getFirstTemplateId());
        $this->see('Generate PDF Template');
        $this->type('', 'email');
        $this->press('Generate and Email');
        $this->seePageIs('/template/generate/'.$this->getFirstTemplateId());
        $this->see('The email field is required.');
    }
}
