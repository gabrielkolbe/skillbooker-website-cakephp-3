<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\IndustriesTable;

/**
 * Jobs\Model\Table\IndustriesTable Test Case
 */
class IndustriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\IndustriesTable
     */
    public $Industries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.industries',
        'plugin.jobs.jobs',
        'plugin.jobs.subindustries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Industries') ? [] : ['className' => 'Jobs\Model\Table\IndustriesTable'];
        $this->Industries = TableRegistry::get('Industries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Industries);

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
