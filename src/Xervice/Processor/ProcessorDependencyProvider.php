<?php
declare(strict_types=1);

namespace Xervice\Processor;


use Xervice\Core\Business\Model\Dependency\Provider\AbstractDependencyProvider;
use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Processor\Business\Model\Processor\ProcessConfigurationPluginCollection;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class ProcessorDependencyProvider extends AbstractDependencyProvider
{
    public const PROCESS_PLUGINS      = 'processor.process.plugins';
    public const VALIDATOR_FACADE     = 'processor.validator.facade';
    public const ARRAY_HANDLER_FACADE = 'processor.array.handler.facade';

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function handleDependencies(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container = $this->addProcessConfigurationPluginCollection($container);
        $container = $this->addValidatorFacade($container);
        $container = $this->addArrayHandlerFacade($container);

        return $container;
    }

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected function addProcessConfigurationPluginCollection(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container[static::PROCESS_PLUGINS] = function (DependencyContainerInterface $container) {
            return new ProcessConfigurationPluginCollection(
                $this->getProcessConfigurationPlugins()
            );
        };
        return $container;
    }

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface[]
     */
    protected function getProcessConfigurationPlugins(): array
    {
        return [];
    }

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected function addValidatorFacade(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container[static::VALIDATOR_FACADE] = function (DependencyContainerInterface $container) {
            return $container->getLocator()->validator()->facade();
        };
        return $container;
    }

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected function addArrayHandlerFacade(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container[static::ARRAY_HANDLER_FACADE] = function (DependencyContainerInterface $container) {
            return $container->getLocator()->arrayHandler()->facade();
        };
        return $container;
    }
}
