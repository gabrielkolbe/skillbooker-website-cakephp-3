<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\UserQualificationsTable;

/**
 * Candidates\Model\Table\UserQualificationsTable Test Case
 */
class UserQualificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\UserQualificationsTable
     */
    public $UserQualifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.user_qualifications',
        'plugin.candidates.users',
        'plugin.candidates.countries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserQualifications') ? [] : ['className' => 'Candidates\Model\Table\UserQualificationsTable'];
        $this->UserQualifications = TableRegistry::get('UserQualifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserQualifications);

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
