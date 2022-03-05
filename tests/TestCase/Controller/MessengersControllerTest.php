<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MessengersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MessengersController Test Case
 */
class MessengersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.messengers',
        'app.users',
        'app.communicationsettings',
        'app.countries',
        'app.states',
        'app.industries',
        'app.candidates',
        'app.jobapplications',
        'app.user_articles',
        'app.user_availability',
        'app.user_employments',
        'app.user_publications',
        'app.user_qualifications',
        'app.user_resumes',
        'app.user_skills',
        'app.jobs',
        'app.jobtypes',
        'app.paymentintervals',
        'app.salarydescs',
        'app.datedescs',
        'app.jobskills',
        'app.receivers'
    ];

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorized()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
