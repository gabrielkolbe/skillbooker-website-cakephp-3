<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\PaymentintervalsTable;

/**
 * Jobs\Model\Table\PaymentintervalsTable Test Case
 */
class PaymentintervalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\PaymentintervalsTable
     */
    public $Paymentintervals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.paymentintervals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Paymentintervals') ? [] : ['className' => 'Jobs\Model\Table\PaymentintervalsTable'];
        $this->Paymentintervals = TableRegistry::get('Paymentintervals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Paymentintervals);

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
