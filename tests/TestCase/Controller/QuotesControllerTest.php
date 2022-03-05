<?php
namespace App\Test\TestCase\Controller;

use App\Controller\QuotesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\QuotesController Test Case
 */
class QuotesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.quotes',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.accomodations',
        'app.bedroomtypes',
        'app.images',
        'app.facilities',
        'app.features',
        'app.facilities_features',
        'app.packages',
        'app.packages_accomodations',
        'app.extras',
        'app.packages_extras',
        'app.quotes_extras',
        'app.packages_facilities',
        'app.menus',
        'app.menu_meals',
        'app.packages_menus',
        'app.quotes_menus',
        'app.quotes_packages',
        'app.quotes_facilities',
        'app.accomodations_features',
        'app.quotes_accomodations'
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
