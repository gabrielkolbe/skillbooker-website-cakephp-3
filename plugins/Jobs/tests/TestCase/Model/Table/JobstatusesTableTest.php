<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\JobstatusesTable;

/**
 * Jobs\Model\Table\JobstatusesTable Test Case
 */
class JobstatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\JobstatusesTable
     */
    public $Jobstatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.jobstatuses',
        'plugin.jobs.jobs',
        'plugin.jobs.users',
        'plugin.jobs.jobtypes',
        'plugin.jobs.jobsalarytypes',
        'plugin.jobs.jobsalarydescs',
        'plugin.jobs.jobdatedescs',
        'plugin.jobs.companies',
        'plugin.jobs.industries',
        'plugin.jobs.subindustries',
        'plugin.jobs.states',
        'plugin.jobs.countries',
        'plugin.jobs.sitesettings',
        'plugin.jobs.job_skills',
        'plugin.jobs.skills',
        'plugin.jobs.jobapplications',
        'plugin.jobs.applicationstatuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Jobstatuses') ? [] : ['className' => 'Jobs\Model\Table\JobstatusesTable'];
        $this->Jobstatuses = TableRegistry::get('Jobstatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jobstatuses);

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
}
