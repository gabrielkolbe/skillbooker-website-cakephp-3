<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FreelancersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FreelancersTable Test Case
 */
class FreelancersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FreelancersTable
     */
    public $Freelancers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.freelancers',
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
        'app.jobskills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Freelancers') ? [] : ['className' => 'App\Model\Table\FreelancersTable'];
        $this->Freelancers = TableRegistry::get('Freelancers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Freelancers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
