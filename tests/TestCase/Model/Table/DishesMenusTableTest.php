<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DishesMenusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DishesMenusTable Test Case
 */
class DishesMenusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DishesMenusTable
     */
    public $DishesMenus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dishes_menus',
        'app.dishes',
        'app.dishes_types',
        'app.menus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DishesMenus') ? [] : ['className' => 'App\Model\Table\DishesMenusTable'];
        $this->DishesMenus = TableRegistry::get('DishesMenus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DishesMenus);

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
