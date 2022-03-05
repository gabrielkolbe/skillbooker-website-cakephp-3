<?php
namespace manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use manager\Model\Table\UserCreditTable;

/**
 * manager\Model\Table\UserCreditTable Test Case
 */
class UserCreditTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \manager\Model\Table\UserCreditTable
     */
    public $UserCredit;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.user_credit',
        'plugin.manager.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserCredit') ? [] : ['className' => 'manager\Model\Table\UserCreditTable'];
        $this->UserCredit = TableRegistry::get('UserCredit', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserCredit);

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
