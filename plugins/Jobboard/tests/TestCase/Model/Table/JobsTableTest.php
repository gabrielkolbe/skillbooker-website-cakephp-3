<?php
namespace Jobboard\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobboard\Model\Table\JobsTable;

/**
 * Jobboard\Model\Table\JobsTable Test Case
 */
class JobsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobboard\Model\Table\JobsTable
     */
    public $Jobs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobboard.jobs',
        'plugin.jobboard.users',
        'plugin.jobboard.jobtypes',
        'plugin.jobboard.paymentintervals',
        'plugin.jobboard.jobsources',
        'plugin.jobboard.salarydescs',
        'plugin.jobboard.datedescs',
        'plugin.jobboard.companies',
        'plugin.jobboard.industries',
        'plugin.jobboard.subindustries',
        'plugin.jobboard.states',
        'plugin.jobboard.countries',
        'plugin.jobboard.jobapplications',
        'plugin.jobboard.jobskills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Jobs') ? [] : ['className' => 'Jobboard\Model\Table\JobsTable'];
        $this->Jobs = TableRegistry::get('Jobs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jobs);

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
