<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\EmailTemplatesTable;

/**
 * Jobs\Model\Table\EmailTemplatesTable Test Case
 */
class EmailTemplatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\EmailTemplatesTable
     */
    public $EmailTemplates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.email_templates',
        'plugin.jobs.layouts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmailTemplates') ? [] : ['className' => 'Jobs\Model\Table\EmailTemplatesTable'];
        $this->EmailTemplates = TableRegistry::get('EmailTemplates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailTemplates);

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
