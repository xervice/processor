<?php
declare(strict_types=1);

namespace XerviceTest\Process\Business\Model\Processor\Helper;


use Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface;
use Xervice\Processor\Business\Model\InputHandler\InputHandlerInterface;
use Xervice\Processor\Business\Model\InputHandler\RawJsonFileRowInputHandler;
use Xervice\Processor\Business\Model\OutputHandler\OutputHandlerInterface;
use Xervice\Processor\Business\Model\OutputHandler\RawJsonFileOutputHandler;

class ProcessConfiguration implements ProcessConfigurationPluginInterface
{
    /**
     * @return string
     */
    public function getProcessName(): string
    {
        return 'TEST_PROCESS';
    }

    /**
     * @return \Xervice\Processor\Business\Model\InputHandler\InputHandlerInterface
     */
    public function getInputHandler(): InputHandlerInterface
    {
        return new RawJsonFileRowInputHandler();
    }

    /**
     * @return \Xervice\Processor\Business\Model\OutputHandler\OutputHandlerInterface
     */
    public function getOutputHandler(): OutputHandlerInterface
    {
        return new RawJsonFileOutputHandler();
    }

    /**
     * @return \Xervice\Processor\Business\Model\ProcessWorker\ProcessWorkerInterface[]
     */
    public function getProcessWorkers(): array
    {
        return [];
    }

    /**
     * @return \Xervice\Validator\Business\Dependency\ValidatorConfigurationProviderPluginInterface[]
     */
    public function getValidatorConfigurationPlugins(): array
    {
        return [];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function process(array $data): array
    {
        // TODO: Implement process() method.
    }

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessHydratorPluginInterface[]
     */
    public function getHydratorPlugins(): array
    {
        // TODO: Implement getHydratorPlugins() method.
    }

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessTranslationPluginInterface[]
     */
    public function getTranslatorPlugins(): array
    {
        // TODO: Implement getTranslatorPlugins() method.
    }
}