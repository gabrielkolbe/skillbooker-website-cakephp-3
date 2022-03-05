<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\TabsTable;

/**
 * Manager\Model\Table\TabsTable Test Case
 */
class TabsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\TabsTable
     */
    public $Tabs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.tabs',
        'plugin.manager.navigations',
        'plugin.manager.navigations_tabs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tabs') ? [] : ['className' => 'Manager\Model\Table\TabsTable'];
        $this->Tabs = TableRegistry::get('Tabs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tabs);

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
