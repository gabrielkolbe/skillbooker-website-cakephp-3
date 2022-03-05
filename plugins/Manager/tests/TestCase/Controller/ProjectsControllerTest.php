<?php
namespace Manager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Manager\Controller\ProjectsController;

/**
 * Manager\Controller\ProjectsController Test Case
 */
class ProjectsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.projects',
        'plugin.manager.users',
        'plugin.manager.communicationsettings',
        'plugin.manager.countries',
        'plugin.manager.states',
        'plugin.manager.industries',
        'plugin.manager.candidates',
        'plugin.manager.jobapplications',
        'plugin.manager.user_articles',
        'plugin.manager.user_availability',
        'plugin.manager.user_employments',
        'plugin.manager.user_publications',
        'plugin.manager.user_qualifications',
        'plugin.manager.user_resumes',
        'plugin.manager.user_skills',
        'plugin.manager.jobs',
        'plugin.manager.jobtypes',
        'plugin.manager.paymentintervals',
        'plugin.manager.salarydescs',
        'plugin.manager.datedescs',
        'plugin.manager.jobskills',
        'plugin.manager.currencies'
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
