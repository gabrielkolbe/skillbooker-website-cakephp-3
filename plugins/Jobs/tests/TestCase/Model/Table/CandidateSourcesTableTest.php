<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\CandidateSourcesTable;

/**
 * Jobs\Model\Table\CandidateSourcesTable Test Case
 */
class CandidateSourcesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\CandidateSourcesTable
     */
    public $CandidateSources;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.candidate_sources',
        'plugin.jobs.candidates',
        'plugin.jobs.candidate_statuses',
        'plugin.jobs.candidate_ratings',
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
        $config = TableRegistry::exists('CandidateSources') ? [] : ['className' => 'Jobs\Model\Table\CandidateSourcesTable'];
        $this->CandidateSources = TableRegistry::get('CandidateSources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CandidateSources);

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
