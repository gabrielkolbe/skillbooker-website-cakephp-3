<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LayoutsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LayoutsTable Test Case
 */
class LayoutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LayoutsTable
     */
    public $Layouts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.layouts',
        'app.types',
        'app.posts',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.activity',
        'app.groups',
        'app.posts_groups',
        'app.users_groups',
        'app.regions',
        'app.posts_regions',
        'app.users_regions',
        'app.statuses',
        'app.comments',
        'app.images',
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
        $config = TableRegistry::exists('Layouts') ? [] : ['className' => 'App\Model\Table\LayoutsTable'];
        $this->Layouts = TableRegistry::get('Layouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Layouts);

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
