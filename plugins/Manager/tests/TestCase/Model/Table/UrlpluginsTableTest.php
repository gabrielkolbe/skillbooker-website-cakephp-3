<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\UrlpluginsTable;

/**
 * Manager\Model\Table\UrlpluginsTable Test Case
 */
class UrlpluginsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\UrlpluginsTable
     */
    public $Urlplugins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.urlplugins'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Urlplugins') ? [] : ['className' => 'Manager\Model\Table\UrlpluginsTable'];
        $this->Urlplugins = TableRegistry::get('Urlplugins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Urlplugins);

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
