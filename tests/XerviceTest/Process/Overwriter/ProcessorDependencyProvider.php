<?php
declare(strict_types=1);

namespace App\Processor;


use Xervice\Processor\ProcessorDependencyProvider as XerviceProcessorDependencyProvider;
use XerviceTest\Process\Helper\ProcessConfiguration;

class ProcessorDependencyProvider extends XerviceProcessorDependencyProvider
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
}