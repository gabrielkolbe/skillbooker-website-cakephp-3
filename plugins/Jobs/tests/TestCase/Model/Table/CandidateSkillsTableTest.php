<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\CandidateSkillsTable;

/**
 * Jobs\Model\Table\CandidateSkillsTable Test Case
 */
class CandidateSkillsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\CandidateSkillsTable
     */
    public $CandidateSkills;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.candidate_skills',
        'plugin.jobs.users',
        'plugin.jobs.skills',
        'plugin.jobs.industries',
        'plugin.jobs.jobs',
        'plugin.jobs.jobtypes',
        'plugin.jobs.candidates',
        'plugin.jobs.candidate_statuses',
        'plugin.jobs.candidate_ratings',
        'plugin.jobs.candidate_sources',
        'plugin.jobs.subindustries',
        'plugin.jobs.companies',
        'plugin.jobs.contactmethods',
        'plugin.jobs.states',
        'plugin.jobs.countries',
        'plugin.jobs.candidate_educations',
        'plugin.jobs.candidate_employments',
        'plugin.jobs.candidate_resumes',
        'plugin.jobs.recruitmentprogress',
        'plugin.jobs.paymentintervals',
        'plugin.jobs.salarydescs',
        'plugin.jobs.jobsources',
        'plugin.jobs.datedescs',
        'plugin.jobs.jobskills',
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
        $config = TableRegistry::exists('CandidateSkills') ? [] : ['className' => 'Jobs\Model\Table\CandidateSkillsTable'];
        $this->CandidateSkills = TableRegistry::get('CandidateSkills', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CandidateSkills);

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
