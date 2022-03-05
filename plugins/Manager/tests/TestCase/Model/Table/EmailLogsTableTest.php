<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\EmailLogsTable;

/**
 * Manager\Model\Table\EmailLogsTable Test Case
 */
class EmailLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\EmailLogsTable
     */
    public $EmailLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.email_logs',
        'plugin.manager.email_templates',
        'plugin.manager.email_layouts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmailLogs') ? [] : ['className' => 'Manager\Model\Table\EmailLogsTable'];
        $this->EmailLogs = TableRegistry::get('EmailLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailLogs);

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
