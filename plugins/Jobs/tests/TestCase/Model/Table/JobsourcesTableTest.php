<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\JobsourcesTable;

/**
 * Jobs\Model\Table\JobsourcesTable Test Case
 */
class JobsourcesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\JobsourcesTable
     */
    public $Jobsources;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.jobsources',
        'plugin.jobs.jobs',
        'plugin.jobs.users',
        'plugin.jobs.jobtypes',
        'plugin.jobs.countries',
        'plugin.jobs.jobstatuses',
        'plugin.jobs.jobsalarytypes',
        'plugin.jobs.jobsalarydescs',
        'plugin.jobs.jobdatedescs',
        'plugin.jobs.companies',
        'plugin.jobs.industries',
        'plugin.jobs.subindustries',
        'plugin.jobs.states',
        'plugin.jobs.job_skills',
        'plugin.jobs.skills',
        'plugin.jobs.levels',
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
        $config = TableRegistry::exists('Jobsources') ? [] : ['className' => 'Jobs\Model\Table\JobsourcesTable'];
        $this->Jobsources = TableRegistry::get('Jobsources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jobsources);

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
