<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BedroomtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BedroomtypesTable Test Case
 */
class BedroomtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BedroomtypesTable
     */
    public $Bedroomtypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bedroomtypes',
        'app.accomodations',
        'app.features',
        'app.accomodations_features',
        'app.facilities',
        'app.events',
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
        'app.posts_tags',
        'app.events_statuses',
        'app.facilities_features'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bedroomtypes') ? [] : ['className' => 'App\Model\Table\BedroomtypesTable'];
        $this->Bedroomtypes = TableRegistry::get('Bedroomtypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bedroomtypes);

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
