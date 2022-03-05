<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactHistoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactHistoryTable Test Case
 */
class ContactHistoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactHistoryTable
     */
    public $ContactHistory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contact_history'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContactHistory') ? [] : ['className' => 'App\Model\Table\ContactHistoryTable'];
        $this->ContactHistory = TableRegistry::get('ContactHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactHistory);

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
