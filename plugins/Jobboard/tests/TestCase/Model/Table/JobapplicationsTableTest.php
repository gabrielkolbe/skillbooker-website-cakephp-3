<?php
namespace Jobboard\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobboard\Model\Table\JobapplicationsTable;

/**
 * Jobboard\Model\Table\JobapplicationsTable Test Case
 */
class JobapplicationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobboard\Model\Table\JobapplicationsTable
     */
    public $Jobapplications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobboard.jobapplications',
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
        'plugin.jobboard.jobskills',
        'plugin.jobboard.applicationstatuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Jobapplications') ? [] : ['className' => 'Jobboard\Model\Table\JobapplicationsTable'];
        $this->Jobapplications = TableRegistry::get('Jobapplications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jobapplications);

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
