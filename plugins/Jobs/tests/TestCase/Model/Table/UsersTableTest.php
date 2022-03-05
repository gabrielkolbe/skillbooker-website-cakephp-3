<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\UsersTable;

/**
 * Jobs\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.users',
        'plugin.jobs.roles',
        'plugin.jobs.countries',
        'plugin.jobs.jobs',
        'plugin.jobs.jobtypes',
        'plugin.jobs.jobstatuses',
        'plugin.jobs.jobsalarytypes',
        'plugin.jobs.jobsalarydescs',
        'plugin.jobs.jobdatedescs',
        'plugin.jobs.companies',
        'plugin.jobs.industries',
        'plugin.jobs.subindustries',
        'plugin.jobs.states',
        'plugin.jobs.sitesettings',
        'plugin.jobs.themes',
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
        $config = TableRegistry::exists('Users') ? [] : ['className' => 'Jobs\Model\Table\UsersTable'];
        $this->Users = TableRegistry::get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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
