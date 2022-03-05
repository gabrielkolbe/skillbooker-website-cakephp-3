<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\CandidateResumesTable;

/**
 * Jobs\Model\Table\CandidateResumesTable Test Case
 */
class CandidateResumesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\CandidateResumesTable
     */
    public $CandidateResumes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.candidate_resumes',
        'plugin.jobs.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CandidateResumes') ? [] : ['className' => 'Jobs\Model\Table\CandidateResumesTable'];
        $this->CandidateResumes = TableRegistry::get('CandidateResumes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CandidateResumes);

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
