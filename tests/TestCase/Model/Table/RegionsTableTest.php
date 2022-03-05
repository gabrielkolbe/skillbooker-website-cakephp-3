<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegionsTable Test Case
 */
class RegionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RegionsTable
     */
    public $Regions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.regions',
        'app.posts',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.activity',
        'app.comments',
        'app.groups',
        'app.posts_groups',
        'app.users_groups',
        'app.users_regions',
        'app.statuses',
        'app.contenttypes',
        'app.layouts',
        'app.layouts_types',
        'app.layouts_contenttypes',
        'app.images',
        'app.posts_regions',
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
        $config = TableRegistry::exists('Regions') ? [] : ['className' => 'App\Model\Table\RegionsTable'];
        $this->Regions = TableRegistry::get('Regions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Regions);

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
