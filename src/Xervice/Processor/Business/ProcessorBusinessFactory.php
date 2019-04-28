<?php
declare(strict_types=1);

namespace Xervice\Processor\Business;


use Xervice\ArrayHandler\Business\ArrayHandlerFacade;
use Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\Processor\Business\Model\Hydrator\DataHydrator;
use Xervice\Processor\Business\Model\Hydrator\DataHydratorInterface;
use Xervice\Processor\Business\Model\Processor\ProcessConfigurationPluginCollection;
use Xervice\Processor\Business\Model\Processor\Processor;
use Xervice\Processor\Business\Model\Processor\ProcessorInterface;
use Xervice\Processor\Business\Model\Translator\DataTranslator;
use Xervice\Processor\Business\Model\Translator\DataTranslatorInterface;
use Xervice\Processor\Communication\Plugin\HydratorFieldHandlerPlugin;
use Xervice\Processor\Communication\Plugin\TranslatorFieldHandlerPlugin;
use Xervice\Processor\ProcessorDependencyProvider;
use Xervice\Validator\Business\ValidatorFacade;

/**
 * @method \Xervice\Processor\ProcessorConfig getConfig()
 */
class ProcessorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Xervice\Processor\Business\Model\Processor\ProcessorInterface
     */
    public function createProcessor(): ProcessorInterface
    {
        return new Processor(
            $this->getProcessConfigurationPluginCollection(),
            $this->getValidatorFacade(),
            $this->createDataHydrator(),
            $this->createDataTranslator()
        );
    }

    /**
     * @return \Xervice\Processor\Business\Model\Translator\DataTranslatorInterface
     */
    public function createDataTranslator(): DataTranslatorInterface
    {
        return new DataTranslator(
            $this->getArrayHandlerFacade(),
            $this->createTranslatorFieldHandlerPlugin()
        );
    }

    /**
     * @return \Xervice\Processor\Business\Model\Hydrator\DataHydratorInterface
     */
    public function createDataHydrator(): DataHydratorInterface
    {
        return new DataHydrator(
            $this->getArrayHandlerFacade(),
            $this->createHydratorFieldHandlerPlugin()
        );
    }

    /**
     * @return \Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface
     */
    public function createTranslatorFieldHandlerPlugin(): FieldHandlerPluginInterface
    {
        return new TranslatorFieldHandlerPlugin();
    }

    /**
     * @return \Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface
     */
    public function createHydratorFieldHandlerPlugin(): FieldHandlerPluginInterface
    {
        return new HydratorFieldHandlerPlugin();
    }

    /**
     * @return \Xervice\Processor\Business\Model\Processor\ProcessConfigurationPluginCollection
     */
    public function getProcessConfigurationPluginCollection(): ProcessConfigurationPluginCollection
    {
        return $this->getDependency(ProcessorDependencyProvider::PROCESS_PLUGINS);
    }

    /**
     * @return \Xervice\Validator\Business\ValidatorFacade
     */
    public function getValidatorFacade(): ValidatorFacade
    {
        return $this->getDependency(ProcessorDependencyProvider::VALIDATOR_FACADE);
    }

    /**
     * @return \Xervice\ArrayHandler\Business\ArrayHandlerFacade
     */
    public function getArrayHandlerFacade(): ArrayHandlerFacade
    {
        return $this->getDependency(ProcessorDependencyProvider::ARRAY_HANDLER_FACADE);
    }
}