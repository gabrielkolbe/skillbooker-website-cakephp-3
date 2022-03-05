<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuotesTable Test Case
 */
class QuotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuotesTable
     */
    public $Quotes;

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
        'app.events',
        'app.events_types',
        'app.events_statuses',
        'app.images',
        'app.facilities',
        'app.features',
        'app.facilities_features',
        'app.packages',
        'app.accomodations',
        'app.bedroomtypes',
        'app.accomodations_features',
        'app.packages_accomodations',
        'app.extras',
        'app.packages_extras',
        'app.packages_facilities',
        'app.menus',
        'app.menu_meals',
        'app.packages_menus',
        'app.quotes_accomodations',
        'app.quotes_extras',
        'app.quotes_facilities',
        'app.quotes_menus',
        'app.quotes_packages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Quotes') ? [] : ['className' => 'App\Model\Table\QuotesTable'];
        $this->Quotes = TableRegistry::get('Quotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Quotes);

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
