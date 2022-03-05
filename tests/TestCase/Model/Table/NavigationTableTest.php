<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NavigationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NavigationTable Test Case
 */
class NavigationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NavigationTable
     */
    public $Navigation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.navigation',
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
        'app.navigation_tabs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Navigation') ? [] : ['className' => 'App\Model\Table\NavigationTable'];
        $this->Navigation = TableRegistry::get('Navigation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Navigation);

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
