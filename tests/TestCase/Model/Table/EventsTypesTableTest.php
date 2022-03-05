<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsTypesTable Test Case
 */
class EventsTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsTypesTable
     */
    public $EventsTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.events_types',
        'app.events',
        'app.facilities',
        'app.features',
        'app.accomodations',
        'app.accomodations_features',
        'app.facilities_features',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.activity',
        'app.comments',
        'app.posts',
        'app.statuses',
        'app.contenttypes',
        'app.layouts',
        'app.layouts_contenttypes',
        'app.images',
        'app.groups',
        'app.posts_groups',
        'app.users_groups',
        'app.regions',
        'app.posts_regions',
        'app.users_regions',
        'app.tags',
        'app.posts_tags',
        'app.events_statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventsTypes') ? [] : ['className' => 'App\Model\Table\EventsTypesTable'];
        $this->EventsTypes = TableRegistry::get('EventsTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventsTypes);

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
