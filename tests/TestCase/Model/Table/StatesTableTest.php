<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatesTable Test Case
 */
class StatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StatesTable
     */
    public $States;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.states',
        'app.countries',
        'app.users',
        'app.roles',
        'app.posts',
        'app.statuses',
        'app.types',
        'app.categories',
        'app.comments',
        'app.images',
        'app.post_tags',
        'app.tags',
        'app.tabs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('States') ? [] : ['className' => 'App\Model\Table\StatesTable'];
        $this->States = TableRegistry::get('States', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->States);

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
