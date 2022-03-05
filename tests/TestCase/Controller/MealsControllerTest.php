<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MealsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MealsController Test Case
 */
class MealsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meals',
        'app.types',
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
        'app.events_statuses',
        'app.menu_meals',
        'app.meals_types',
        'app.meals_meals_types',
        'app.menus'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
