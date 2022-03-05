<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FlagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FlagsTable Test Case
 */
class FlagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FlagsTable
     */
    public $Flags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.flags',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.events',
        'app.images',
        'app.users_events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Flags') ? [] : ['className' => 'App\Model\Table\FlagsTable'];
        $this->Flags = TableRegistry::get('Flags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Flags);

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
