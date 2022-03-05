<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeaturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeaturesTable Test Case
 */
class FeaturesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeaturesTable
     */
    public $Features;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.features',
        'app.accomodations',
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
        $config = TableRegistry::exists('Features') ? [] : ['className' => 'App\Model\Table\FeaturesTable'];
        $this->Features = TableRegistry::get('Features', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Features);

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
