<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AvenuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AvenuesTable Test Case
 */
class AvenuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AvenuesTable
     */
    public $Avenues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.avenues',
        'app.events',
        'app.images'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Avenues') ? [] : ['className' => 'App\Model\Table\AvenuesTable'];
        $this->Avenues = TableRegistry::get('Avenues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Avenues);

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
