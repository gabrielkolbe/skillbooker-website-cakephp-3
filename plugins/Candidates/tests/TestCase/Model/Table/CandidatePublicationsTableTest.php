<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\CandidatePublicationsTable;

/**
 * Candidates\Model\Table\CandidatePublicationsTable Test Case
 */
class CandidatePublicationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\CandidatePublicationsTable
     */
    public $CandidatePublications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.candidate_publications',
        'plugin.candidates.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CandidatePublications') ? [] : ['className' => 'Candidates\Model\Table\CandidatePublicationsTable'];
        $this->CandidatePublications = TableRegistry::get('CandidatePublications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CandidatePublications);

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
