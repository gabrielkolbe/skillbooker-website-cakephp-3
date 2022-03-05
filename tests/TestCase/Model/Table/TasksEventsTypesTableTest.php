<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TasksEventsTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TasksEventsTypesTable Test Case
 */
class TasksEventsTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TasksEventsTypesTable
     */
    public $TasksEventsTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tasks_events_types',
        'app.tasks',
        'app.events_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TasksEventsTypes') ? [] : ['className' => 'App\Model\Table\TasksEventsTypesTable'];
        $this->TasksEventsTypes = TableRegistry::get('TasksEventsTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TasksEventsTypes);

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
