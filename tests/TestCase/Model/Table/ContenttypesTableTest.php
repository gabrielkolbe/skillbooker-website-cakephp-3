<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContenttypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContenttypesTable Test Case
 */
class ContenttypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContenttypesTable
     */
    public $Contenttypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contenttypes',
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
        'app.regions',
        'app.posts_regions',
        'app.users_regions',
        'app.statuses',
        'app.images',
        'app.tags',
        'app.posts_tags',
        'app.layouts',
        'app.layouts_types',
        'app.layouts_contenttypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Contenttypes') ? [] : ['className' => 'App\Model\Table\ContenttypesTable'];
        $this->Contenttypes = TableRegistry::get('Contenttypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contenttypes);

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
