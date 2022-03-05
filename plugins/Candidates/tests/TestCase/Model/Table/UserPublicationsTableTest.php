<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\UserPublicationsTable;

/**
 * Candidates\Model\Table\UserPublicationsTable Test Case
 */
class UserPublicationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\UserPublicationsTable
     */
    public $UserPublications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.user_publications',
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
        $config = TableRegistry::exists('UserPublications') ? [] : ['className' => 'Candidates\Model\Table\UserPublicationsTable'];
        $this->UserPublications = TableRegistry::get('UserPublications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPublications);

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
