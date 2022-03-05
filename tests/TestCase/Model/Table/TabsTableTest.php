<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TabsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TabsTable Test Case
 */
class TabsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TabsTable
     */
    public $Tabs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tabs',
        'app.navigations',
        'app.navigations_tabs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tabs') ? [] : ['className' => 'App\Model\Table\TabsTable'];
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
