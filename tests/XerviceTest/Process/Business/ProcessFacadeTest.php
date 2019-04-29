<?php namespace XerviceTest\Process\Business;

use Codeception\Test\Unit;
use DataProvider\ProcessRunDataProvider;

require dirname(__DIR__) . '/Overwriter/ProcessorDependencyProvider.php';

/**
 * @method \Xervice\Processor\Business\ProcessorFacade getFacade()
 */
class ProcessFacadeTest extends Unit
{
    /**
     * @var \XerviceTest\XerviceTestTester
     */
    protected $tester;

    /**
     * @var string
     */
    private $inputFile;

    /**
     * @var string
     */
    private $outputFile;

    protected function _before()
    {
        $this->inputFile = __DIR__ . '/input.json';
        $this->outputFile = __DIR__ . '/output.json';
        file_put_contents(
            $this->inputFile,
            json_encode(
                [
                    'test' => [
                        'var1',
                        'var2'
                    ],

                ]
            )
        );
    }

    protected function _after()
    {
        @unlink($this->inputFile);
        @unlink($this->outputFile);
    }

    /**
     * @group Xervice
     * @group Processor
     * @group Business
     * @group ProcessorFacade
     * @group Integration
     */
    public function testRunProcess()
    {
        $conf = (new ProcessRunDataProvider())
            ->setName('TEST_PROCESS')
            ->setInput($this->inputFile)
            ->setOutput($this->outputFile);

        $this->tester->getFacade()->runProcess($conf);

        $this->assertFileExists($this->outputFile);

        $content = file_get_contents($this->outputFile);
        $content = json_decode($content, true);

        $this->assertEquals(
            [
                "newValues" => [
                    [
                        "var1"
                    ],
                    [
                        "var2"
                    ]
                ],
                "transOne" => [
                    [
                        "var1"
                    ],
                    [
                        "var2"
                    ]
                ],
                "transTwo" => [
                    [
                        "var1"
                    ],
                    [
                        "var2"
                    ]
                ],
                'isProcessed' => true
            ],
            $content
        );

    }
}