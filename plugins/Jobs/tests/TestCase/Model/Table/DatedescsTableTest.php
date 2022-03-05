<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\DatedescsTable;

/**
 * Jobs\Model\Table\DatedescsTable Test Case
 */
class DatedescsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\DatedescsTable
     */
    public $Datedescs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.datedescs',
        'plugin.jobs.jobs',
        'plugin.jobs.users',
        'plugin.jobs.jobtypes',
        'plugin.jobs.recruitmentprogress',
        'plugin.jobs.jobsalarytypes',
        'plugin.jobs.jobsalarydescs',
        'plugin.jobs.jobsources',
        'plugin.jobs.jobdatedescs',
        'plugin.jobs.companies',
        'plugin.jobs.contactmethods',
        'plugin.jobs.states',
        'plugin.jobs.countries',
        'plugin.jobs.industries',
        'plugin.jobs.subindustries',
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
        $config = TableRegistry::exists('Datedescs') ? [] : ['className' => 'Jobs\Model\Table\DatedescsTable'];
        $this->Datedescs = TableRegistry::get('Datedescs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Datedescs);

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
