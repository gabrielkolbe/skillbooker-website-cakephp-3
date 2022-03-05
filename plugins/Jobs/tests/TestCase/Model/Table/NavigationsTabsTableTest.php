<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\NavigationsTabsTable;

/**
 * Jobs\Model\Table\NavigationsTabsTable Test Case
 */
class NavigationsTabsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\NavigationsTabsTable
     */
    public $NavigationsTabs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.navigations_tabs',
        'plugin.jobs.navigations',
        'plugin.jobs.tabs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NavigationsTabs') ? [] : ['className' => 'Jobs\Model\Table\NavigationsTabsTable'];
        $this->NavigationsTabs = TableRegistry::get('NavigationsTabs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NavigationsTabs);

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
