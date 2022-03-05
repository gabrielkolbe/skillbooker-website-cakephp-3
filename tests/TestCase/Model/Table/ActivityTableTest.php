<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityTable Test Case
 */
class ActivityTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityTable
     */
    public $Activity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.comments',
        'app.posts',
        'app.statuses',
        'app.types',
        'app.layouts',
        'app.layouts_types',
        'app.images',
        'app.groups',
        'app.posts_groups',
        'app.users_groups',
        'app.regions',
        'app.posts_regions',
        'app.users_regions',
        'app.tags',
        'app.posts_tags',
        'app.groups_activity',
        'app.regions_activity'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Activity') ? [] : ['className' => 'App\Model\Table\ActivityTable'];
        $this->Activity = TableRegistry::get('Activity', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Activity);

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
