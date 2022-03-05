<?php
namespace Jobs\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Jobs\Model\Table\ContactcategoriesTable;

/**
 * Jobs\Model\Table\ContactcategoriesTable Test Case
 */
class ContactcategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Jobs\Model\Table\ContactcategoriesTable
     */
    public $Contactcategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.jobs.contactcategories',
        'plugin.jobs.users',
        'plugin.jobs.companies',
        'plugin.jobs.contactmethods',
        'plugin.jobs.states',
        'plugin.jobs.jobs',
        'plugin.jobs.jobtypes',
        'plugin.jobs.countries',
        'plugin.jobs.jobstatuses',
        'plugin.jobs.jobsalarytypes',
        'plugin.jobs.jobsalarydescs',
        'plugin.jobs.jobsources',
        'plugin.jobs.jobdatedescs',
        'plugin.jobs.industries',
        'plugin.jobs.subindustries',
        'plugin.jobs.job_skills',
        'plugin.jobs.skills',
        'plugin.jobs.levels',
        'plugin.jobs.jobapplications',
        'plugin.jobs.applicationstatuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Contactcategories') ? [] : ['className' => 'Jobs\Model\Table\ContactcategoriesTable'];
        $this->Contactcategories = TableRegistry::get('Contactcategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contactcategories);

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
