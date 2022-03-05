<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\ImageTypesTable;

/**
 * Jobs\Model\Table\ImageTypesTable Test Case
 */
class ImageTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\ImageTypesTable
     */
    public $ImageTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.image_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ImageTypes') ? [] : ['className' => 'Jobs\Model\Table\ImageTypesTable'];
        $this->ImageTypes = TableRegistry::get('ImageTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ImageTypes);

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
