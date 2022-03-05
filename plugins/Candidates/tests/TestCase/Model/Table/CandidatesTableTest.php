<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\CandidatesTable;

/**
 * Candidates\Model\Table\CandidatesTable Test Case
 */
class CandidatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\CandidatesTable
     */
    public $Candidates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.candidates',
        'plugin.candidates.users',
        'plugin.candidates.candidate_statuses',
        'plugin.candidates.candidate_ratings',
        'plugin.candidates.candidate_sources',
        'plugin.candidates.companies',
        'plugin.candidates.jobtypes',
        'plugin.candidates.contactmethods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Candidates') ? [] : ['className' => 'Candidates\Model\Table\CandidatesTable'];
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
