<?php namespace XerviceTest\Process\Business\Model\Processor;

use Xervice\Processor\Business\Model\Processor\ProcessConfigurationPluginCollection;

class ProcessorTest extends \Codeception\Test\Unit
{
    /**
     * @var \XerviceTest\XerviceTestTester
     */
    protected $tester;


    public function testProcessor()
    {
        $configCollection = new ProcessConfigurationPluginCollection();

    }
}