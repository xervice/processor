<?php
declare(strict_types=1);

namespace XerviceTest\Process\Helper;


use Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface;
use Xervice\Processor\Business\Model\InputHandler\InputHandlerInterface;
use Xervice\Processor\Business\Model\InputHandler\RawJsonFileRowInputHandler;
use Xervice\Processor\Business\Model\OutputHandler\OutputHandlerInterface;
use Xervice\Processor\Business\Model\OutputHandler\RawJsonFileOutputHandler;
use XerviceTest\Process\Helper\Models\TestHydrator;
use XerviceTest\Process\Helper\Models\TestTranslator;
use XerviceTest\Process\Helper\Models\TestValidator;

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
     * @param array $data
     *
     * @return array
     */
    public function process(array $data): array
    {
        return $data;
    }

    /**
     * @return \Xervice\Validator\Business\Dependency\ValidatorConfigurationProviderPluginInterface[]
     */
    public function getValidatorConfigurationPlugins(): array
    {
        return [
            new TestValidator()
        ];
    }

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessHydratorPluginInterface[]
     */
    public function getHydratorPlugins(): array
    {
        return [
            new TestHydrator()
        ];
    }

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessTranslationPluginInterface[]
     */
    public function getTranslatorPlugins(): array
    {
        return [
            new TestTranslator()
        ];
    }
}