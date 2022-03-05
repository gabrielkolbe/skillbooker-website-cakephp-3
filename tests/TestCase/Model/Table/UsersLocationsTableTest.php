<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersLocationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersLocationsTable Test Case
 */
class UsersLocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersLocationsTable
     */
    public $UsersLocations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_locations',
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
        'app.locations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersLocations') ? [] : ['className' => 'App\Model\Table\UsersLocationsTable'];
        $this->UsersLocations = TableRegistry::get('UsersLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersLocations);

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
