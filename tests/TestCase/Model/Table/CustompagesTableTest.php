<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustompagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustompagesTable Test Case
 */
class CustompagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustompagesTable
     */
    public $Custompages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.custompages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Custompages') ? [] : ['className' => 'App\Model\Table\CustompagesTable'];
        $this->Custompages = TableRegistry::get('Custompages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Custompages);

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
