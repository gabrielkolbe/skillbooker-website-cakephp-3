<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\NavigationsTable;

/**
 * Jobs\Model\Table\NavigationsTable Test Case
 */
class NavigationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\NavigationsTable
     */
    public $Navigations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.navigations',
        'plugin.jobs.tabs',
        'plugin.jobs.navigations_tabs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Navigations') ? [] : ['className' => 'Jobs\Model\Table\NavigationsTable'];
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
