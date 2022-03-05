<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\CandidateQualificationsTable;

/**
 * Candidates\Model\Table\CandidateQualificationsTable Test Case
 */
class CandidateQualificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\CandidateQualificationsTable
     */
    public $CandidateQualifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.candidate_qualifications',
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
        $config = TableRegistry::exists('CandidateQualifications') ? [] : ['className' => 'Candidates\Model\Table\CandidateQualificationsTable'];
        $this->CandidateQualifications = TableRegistry::get('CandidateQualifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CandidateQualifications);

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
