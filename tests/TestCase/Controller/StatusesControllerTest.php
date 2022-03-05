<?php
namespace App\Test\TestCase\Controller;

use App\Controller\StatusesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\StatusesController Test Case
 */
class StatusesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.statuses',
        'app.posts',
        'app.users',
        'app.roles',
        'app.countries',
        'app.states',
        'app.groups',
        'app.posts_groups',
        'app.users_groups',
        'app.regions',
        'app.posts_regions',
        'app.users_regions',
        'app.types',
        'app.comments',
        'app.images',
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
