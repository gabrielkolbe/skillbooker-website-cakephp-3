<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\UserSourcesTable;

/**
 * Candidates\Model\Table\UserSourcesTable Test Case
 */
class UserSourcesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\UserSourcesTable
     */
    public $UserSources;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.user_sources'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserSources') ? [] : ['className' => 'Candidates\Model\Table\UserSourcesTable'];
        $this->UserSources = TableRegistry::get('UserSources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserSources);

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
