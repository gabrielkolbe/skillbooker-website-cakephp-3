<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\SalesoptionsTable;

/**
 * Manager\Model\Table\SalesoptionsTable Test Case
 */
class SalesoptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\SalesoptionsTable
     */
    public $Salesoptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.salesoptions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Salesoptions') ? [] : ['className' => 'Manager\Model\Table\SalesoptionsTable'];
        $this->Salesoptions = TableRegistry::get('Salesoptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Salesoptions);

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
