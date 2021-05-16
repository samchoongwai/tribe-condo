<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitorLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitorLogsTable Test Case
 */
class VisitorLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitorLogsTable
     */
    protected $VisitorLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.VisitorLogs',
        'app.Units',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VisitorLogs') ? [] : ['className' => VisitorLogsTable::class];
        $this->VisitorLogs = $this->getTableLocator()->get('VisitorLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->VisitorLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
