<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsStatusesTable Test Case
 */
class EventsStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsStatusesTable
     */
    public $EventsStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.events_statuses',
        'app.events',
        'app.events_facilities',
        'app.events_types',
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
        $config = TableRegistry::exists('EventsStatuses') ? [] : ['className' => 'App\Model\Table\EventsStatusesTable'];
        $this->EventsStatuses = TableRegistry::get('EventsStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventsStatuses);

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
