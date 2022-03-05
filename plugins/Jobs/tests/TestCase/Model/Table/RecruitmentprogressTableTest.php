<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\RecruitmentprogressTable;

/**
 * Jobs\Model\Table\RecruitmentprogressTable Test Case
 */
class RecruitmentprogressTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\RecruitmentprogressTable
     */
    public $Recruitmentprogress;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.recruitmentprogress'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Recruitmentprogress') ? [] : ['className' => 'Jobs\Model\Table\RecruitmentprogressTable'];
        $this->Recruitmentprogress = TableRegistry::get('Recruitmentprogress', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Recruitmentprogress);

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
