<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Dependency;


use Xervice\Processor\Business\Model\InputHandler\InputHandlerInterface;
use Xervice\Processor\Business\Model\OutputHandler\OutputHandlerInterface;

interface ProcessConfigurationPluginInterface
{
    /**
     * @return string
     */
    public function getProcessName(): string;

    /**
     * @return \Xervice\Processor\Business\Model\InputHandler\InputHandlerInterface
     */
    public function getInputHandler(): InputHandlerInterface;

    /**
     * @return \Xervice\Processor\Business\Model\OutputHandler\OutputHandlerInterface
     */
    public function getOutputHandler(): OutputHandlerInterface;

    /**
     * @param array $data
     *
     * @return array
     */
    public function process(array $data): array;

    /**
     * @return \Xervice\Processor\Business\Dependency\ValidatorConfigurationProviderPluginInterface[]
     */
    public function getValidatorConfigurationPlugins(): array;

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessHydratorPluginInterface[]
     */
    public function getHydratorPlugins(): array;

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessTranslationPluginInterface[]
     */
    public function getTranslatorPlugins(): array;
}