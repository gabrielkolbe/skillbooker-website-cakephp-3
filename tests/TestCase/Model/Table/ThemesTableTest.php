<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThemesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThemesTable Test Case
 */
class ThemesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ThemesTable
     */
    public $Themes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.themes',
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
        $config = TableRegistry::exists('Themes') ? [] : ['className' => 'App\Model\Table\ThemesTable'];
        $this->Themes = TableRegistry::get('Themes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Themes);

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
