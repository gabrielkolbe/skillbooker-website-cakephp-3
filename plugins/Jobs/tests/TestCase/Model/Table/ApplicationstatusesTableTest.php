<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\ApplicationstatusesTable;

/**
 * Jobs\Model\Table\ApplicationstatusesTable Test Case
 */
class ApplicationstatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\ApplicationstatusesTable
     */
    public $Applicationstatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.applicationstatuses',
        'plugin.jobs.jobapplications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Applicationstatuses') ? [] : ['className' => 'Jobs\Model\Table\ApplicationstatusesTable'];
        $this->Applicationstatuses = TableRegistry::get('Applicationstatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Applicationstatuses);

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
