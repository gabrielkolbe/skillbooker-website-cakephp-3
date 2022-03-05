<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\ImagesTable;

/**
 * Jobs\Model\Table\ImagesTable Test Case
 */
class ImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\ImagesTable
     */
    public $Images;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.images',
        'plugin.jobs.events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Images') ? [] : ['className' => 'Jobs\Model\Table\ImagesTable'];
        $this->Images = TableRegistry::get('Images', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Images);

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
