<?php
declare(strict_types=1);

namespace App\Processor;


use XerviceTest\Process\Helper\Models\TestTranslatorFunction;
use XerviceTest\Process\Helper\ProcessConfiguration;

class ProcessorDependencyProvider extends \Xervice\Processor\ProcessorDependencyProvider
{
    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface[]
     */
    protected function getProcessConfigurationPlugins(): array
    {
        return [
            new ProcessConfiguration()
        ];
    }

    /**
     * @return \Xervice\Processor\Business\Model\Translator\TranslatorInterface[]
     */
    protected function getTranslatorFunctions(): array
    {
        return [
            new TestTranslatorFunction()
        ];
    }
}