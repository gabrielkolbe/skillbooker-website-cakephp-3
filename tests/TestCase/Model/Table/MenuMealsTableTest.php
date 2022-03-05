<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuMealsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuMealsTable Test Case
 */
class MenuMealsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuMealsTable
     */
    public $MenuMeals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menu_meals',
        'app.meals',
        'app.meals_types',
        'app.meals_meals_types',
        'app.menus',
        'app.meals_menus',
        'app.images',
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
        'app.contenttypes',
        'app.layouts',
        'app.layouts_contenttypes',
        'app.tags',
        'app.posts_tags',
        'app.events',
        'app.facilities',
        'app.features',
        'app.accomodations',
        'app.accomodations_features',
        'app.bedroomtypes',
        'app.facilities_features',
        'app.events_types',
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
        $config = TableRegistry::exists('MenuMeals') ? [] : ['className' => 'App\Model\Table\MenuMealsTable'];
        $this->MenuMeals = TableRegistry::get('MenuMeals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuMeals);

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
