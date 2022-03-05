<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\JobtypesTable;

/**
 * Jobs\Model\Table\JobtypesTable Test Case
 */
class JobtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\JobtypesTable
     */
    public $Jobtypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.jobtypes',
        'plugin.jobs.candidates',
        'plugin.jobs.candidate_statuses',
        'plugin.jobs.candidate_ratings',
        'plugin.jobs.candidate_sources',
        'plugin.jobs.industries',
        'plugin.jobs.jobs',
        'plugin.jobs.users',
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
        'plugin.jobs.jobskills',
        'plugin.jobs.skills',
        'plugin.jobs.jobapplications',
        'plugin.jobs.applicationstatuses',
        'plugin.jobs.candidate_educations',
        'plugin.jobs.candidate_employments',
        'plugin.jobs.candidate_resumes',
        'plugin.jobs.candidate_skills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Jobtypes') ? [] : ['className' => 'Jobs\Model\Table\JobtypesTable'];
        $this->Jobtypes = TableRegistry::get('Jobtypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jobtypes);

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
