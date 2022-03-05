<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\CandidatesTable;

/**
 * Manager\Model\Table\CandidatesTable Test Case
 */
class CandidatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\CandidatesTable
     */
    public $Candidates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.candidates',
        'plugin.manager.users',
        'plugin.manager.roles',
        'plugin.manager.countries',
        'plugin.manager.states',
        'plugin.manager.jobs',
        'plugin.manager.candidate_educations',
        'plugin.manager.candidate_employments',
        'plugin.manager.candidate_resumes',
        'plugin.manager.candidate_skills',
        'plugin.manager.candidate_statuses',
        'plugin.manager.candidate_ratings',
        'plugin.manager.candidate_sources',
        'plugin.manager.companies',
        'plugin.manager.jobtypes',
        'plugin.manager.contactmethods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Candidates') ? [] : ['className' => 'Manager\Model\Table\CandidatesTable'];
        $this->Candidates = TableRegistry::get('Candidates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Candidates);

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
