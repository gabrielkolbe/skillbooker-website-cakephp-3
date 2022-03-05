<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\PaymentsTable;

/**
 * Manager\Model\Table\PaymentsTable Test Case
 */
class PaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\PaymentsTable
     */
    public $Payments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.payments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Payments') ? [] : ['className' => 'Manager\Model\Table\PaymentsTable'];
        $this->Payments = TableRegistry::get('Payments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Payments);

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
