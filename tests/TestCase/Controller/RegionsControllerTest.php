<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RegionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RegionsController Test Case
 */
class RegionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.regions',
        'app.tabs',
        'app.navigation',
        'app.navigation_tabs',
        'app.images',
        'app.posts',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.groups',
        'app.users_groups',
        'app.users_regions',
        'app.statuses',
        'app.types',
        'app.layouts',
        'app.commenttypes',
        'app.comments',
        'app.posts_regions',
        'app.tags',
        'app.posts_tags'
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
