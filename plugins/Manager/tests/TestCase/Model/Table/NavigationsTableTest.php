<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\NavigationsTable;

/**
 * Manager\Model\Table\NavigationsTable Test Case
 */
class NavigationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\NavigationsTable
     */
    public $Navigations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.navigations',
        'plugin.manager.tabs',
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
        $config = TableRegistry::exists('Navigations') ? [] : ['className' => 'Manager\Model\Table\NavigationsTable'];
        $this->Navigations = TableRegistry::get('Navigations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Navigations);

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
