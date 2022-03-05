<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\EmailLayoutsTable;

/**
 * Jobs\Model\Table\EmailLayoutsTable Test Case
 */
class EmailLayoutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\EmailLayoutsTable
     */
    public $EmailLayouts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.email_layouts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmailLayouts') ? [] : ['className' => 'Jobs\Model\Table\EmailLayoutsTable'];
        $this->EmailLayouts = TableRegistry::get('EmailLayouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailLayouts);

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
