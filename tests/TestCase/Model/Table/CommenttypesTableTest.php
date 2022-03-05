<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommenttypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommenttypesTable Test Case
 */
class CommenttypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommenttypesTable
     */
    public $Commenttypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.commenttypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Commenttypes') ? [] : ['className' => 'App\Model\Table\CommenttypesTable'];
        $this->Commenttypes = TableRegistry::get('Commenttypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Commenttypes);

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
