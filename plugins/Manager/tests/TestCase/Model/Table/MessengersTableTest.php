<?php
namespace Manager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Manager\Model\Table\MessengersTable;

/**
 * Manager\Model\Table\MessengersTable Test Case
 */
class MessengersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Manager\Model\Table\MessengersTable
     */
    public $Messengers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.manager.messengers',
        'plugin.manager.users',
        'plugin.manager.roles',
        'plugin.manager.countries',
        'plugin.manager.states',
        'plugin.manager.jobs',
        'plugin.manager.candidate_educations',
        'plugin.manager.candidate_employments',
        'plugin.manager.candidate_resumes',
        'plugin.manager.candidate_skills',
        'plugin.manager.candidates',
        'plugin.manager.senders',
        'plugin.manager.receivers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Messengers') ? [] : ['className' => 'Manager\Model\Table\MessengersTable'];
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
