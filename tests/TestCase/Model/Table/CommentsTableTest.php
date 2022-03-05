<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentsTable Test Case
 */
class CommentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentsTable
     */
    public $Comments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.comments',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.activity',
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
        'app.posts_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Comments') ? [] : ['className' => 'App\Model\Table\CommentsTable'];
        $this->Comments = TableRegistry::get('Comments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Comments);

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
