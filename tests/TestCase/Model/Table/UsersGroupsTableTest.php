<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersGroupsTable Test Case
 */
class UsersGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersGroupsTable
     */
    public $UsersGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_groups',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.usercategories',
        'app.posts',
        'app.statuses',
        'app.types',
        'app.categories',
        'app.comments',
        'app.images',
        'app.tags',
        'app.posts_tags',
        'app.groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersGroups') ? [] : ['className' => 'App\Model\Table\UsersGroupsTable'];
        $this->UsersGroups = TableRegistry::get('UsersGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersGroups);

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
