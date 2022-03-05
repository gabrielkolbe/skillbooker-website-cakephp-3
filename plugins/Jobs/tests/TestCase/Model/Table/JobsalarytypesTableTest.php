<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\JobsalarytypesTable;

/**
 * Jobs\Model\Table\JobsalarytypesTable Test Case
 */
class JobsalarytypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\JobsalarytypesTable
     */
    public $Jobsalarytypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.jobsalarytypes',
        'plugin.jobs.jobs',
        'plugin.jobs.users',
        'plugin.jobs.jobtypes',
        'plugin.jobs.jobstatuses',
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
        $config = TableRegistry::exists('Jobsalarytypes') ? [] : ['className' => 'Jobs\Model\Table\JobsalarytypesTable'];
        $this->Jobsalarytypes = TableRegistry::get('Jobsalarytypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jobsalarytypes);

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
