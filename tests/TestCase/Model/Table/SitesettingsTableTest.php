<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SitesettingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SitesettingsTable Test Case
 */
class SitesettingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SitesettingsTable
     */
    public $Sitesettings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sitesettings',
        'app.countries',
        'app.states',
        'app.users',
        'app.roles',
        'app.usercategories',
        'app.posts',
        'app.statuses',
        'app.types',
        'app.categories',
        'app.comments',
        'app.images',
        'app.post_tags',
        'app.tags',
        'app.tabs',
        'app.navigation',
        'app.navigation_tabs',
        'app.themes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sitesettings') ? [] : ['className' => 'App\Model\Table\SitesettingsTable'];
        $this->Sitesettings = TableRegistry::get('Sitesettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sitesettings);

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
