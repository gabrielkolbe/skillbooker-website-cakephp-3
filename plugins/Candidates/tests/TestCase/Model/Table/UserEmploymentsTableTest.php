<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\UserEmploymentsTable;

/**
 * Candidates\Model\Table\UserEmploymentsTable Test Case
 */
class UserEmploymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\UserEmploymentsTable
     */
    public $UserEmployments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.user_employments',
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
        $config = TableRegistry::exists('UserEmployments') ? [] : ['className' => 'Candidates\Model\Table\UserEmploymentsTable'];
        $this->UserEmployments = TableRegistry::get('UserEmployments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserEmployments);

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
