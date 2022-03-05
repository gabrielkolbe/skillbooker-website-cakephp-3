<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TasksRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TasksRolesTable Test Case
 */
class TasksRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TasksRolesTable
     */
    public $TasksRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tasks_roles',
        'app.tasks',
        'app.tasks_users',
        'app.taskstatuses',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TasksRoles') ? [] : ['className' => 'App\Model\Table\TasksRolesTable'];
        $this->TasksRoles = TableRegistry::get('TasksRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TasksRoles);

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
