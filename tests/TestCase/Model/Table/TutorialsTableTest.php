<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TutorialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TutorialsTable Test Case
 */
class TutorialsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TutorialsTable
     */
    public $Tutorials;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tutorials',
        'app.tutorial_categories',
        'app.tutorial_comments',
        'app.tutorial_images'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tutorials') ? [] : ['className' => 'App\Model\Table\TutorialsTable'];
        $this->Tutorials = TableRegistry::get('Tutorials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tutorials);

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
