<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TagsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TagsController Test Case
 */
class TagsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tags',
        'app.posts',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.groups',
        'app.users_groups',
        'app.regions',
        'app.tabs',
        'app.navigation',
        'app.navigation_tabs',
        'app.posts_regions',
        'app.users_regions',
        'app.statuses',
        'app.types',
        'app.layouts',
        'app.commenttypes',
        'app.comments',
        'app.images',
        'app.posts_groups',
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
