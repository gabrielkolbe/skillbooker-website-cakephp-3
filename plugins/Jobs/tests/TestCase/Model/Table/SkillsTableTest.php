<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\SkillsTable;

/**
 * Jobs\Model\Table\SkillsTable Test Case
 */
class SkillsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\SkillsTable
     */
    public $Skills;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.skills',
        'plugin.jobs.industries',
        'plugin.jobs.jobs',
        'plugin.jobs.users',
        'plugin.jobs.jobtypes',
        'plugin.jobs.recruitmentprogress',
        'plugin.jobs.paymentintervals',
        'plugin.jobs.salarydescs',
        'plugin.jobs.jobsources',
        'plugin.jobs.datedescs',
        'plugin.jobs.companies',
        'plugin.jobs.contactmethods',
        'plugin.jobs.states',
        'plugin.jobs.countries',
        'plugin.jobs.subindustries',
        'plugin.jobs.job_skills',
        'plugin.jobs.jobapplications',
        'plugin.jobs.applicationstatuses',
        'plugin.jobs.jobskills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Skills') ? [] : ['className' => 'Jobs\Model\Table\SkillsTable'];
        $this->Skills = TableRegistry::get('Skills', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Skills);

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
