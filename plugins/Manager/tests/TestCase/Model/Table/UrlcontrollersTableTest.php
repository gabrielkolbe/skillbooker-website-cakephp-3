<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\UrlcontrollersTable;

/**
 * Manager\Model\Table\UrlcontrollersTable Test Case
 */
class UrlcontrollersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\UrlcontrollersTable
     */
    public $Urlcontrollers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.urlcontrollers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Urlcontrollers') ? [] : ['className' => 'Manager\Model\Table\UrlcontrollersTable'];
        $this->Urlcontrollers = TableRegistry::get('Urlcontrollers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Urlcontrollers);

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
