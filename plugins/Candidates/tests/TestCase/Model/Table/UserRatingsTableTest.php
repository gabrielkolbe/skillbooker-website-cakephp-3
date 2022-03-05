<?php
namespace Candidates\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Candidates\Model\Table\UserRatingsTable;

/**
 * Candidates\Model\Table\UserRatingsTable Test Case
 */
class UserRatingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Candidates\Model\Table\UserRatingsTable
     */
    public $UserRatings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.candidates.user_ratings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserRatings') ? [] : ['className' => 'Candidates\Model\Table\UserRatingsTable'];
        $this->UserRatings = TableRegistry::get('UserRatings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserRatings);

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
