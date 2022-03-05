<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MessengersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MessengersTable Test Case
 */
class MessengersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MessengersTable
     */
    public $Messengers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.messengers',
        'app.users',
        'app.communicationsettings',
        'app.countries',
        'app.states',
        'app.industries',
        'app.candidates',
        'app.jobapplications',
        'app.user_articles',
        'app.user_availability',
        'app.user_employments',
        'app.user_publications',
        'app.user_qualifications',
        'app.user_resumes',
        'app.user_skills',
        'app.jobs',
        'app.jobtypes',
        'app.paymentintervals',
        'app.salarydescs',
        'app.datedescs',
        'app.jobskills',
        'app.receivers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Messengers') ? [] : ['className' => 'App\Model\Table\MessengersTable'];
        $this->Messengers = TableRegistry::get('Messengers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Messengers);

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
