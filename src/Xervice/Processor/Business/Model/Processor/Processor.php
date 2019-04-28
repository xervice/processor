<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Processor;


use DataProvider\ProcessRunDataProvider;
use Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface;
use Xervice\Processor\Business\Exception\ProcessException;
use Xervice\Processor\Business\Exception\ProcessNotFoundException;
use Xervice\Processor\Business\Model\Hydrator\DataHydratorInterface;
use Xervice\Processor\Business\Model\Translator\DataTranslatorInterface;
use Xervice\Validator\Business\Exception\ValidationException;
use Xervice\Validator\Business\ValidatorFacade;

class Processor implements ProcessorInterface
{
    /**
     * @var \Xervice\Processor\Business\Model\Processor\ProcessConfigurationPluginCollection
     */
    private $processorConfigurationPluginCollection;

    /**
     * @var \Xervice\Validator\Business\ValidatorFacade
     */
    private $validatorFacade;

    /**
     * @var \Xervice\Processor\Business\Model\Hydrator\DataHydratorInterface
     */
    private $dataHydrator;

    /**
     * @var \Xervice\Processor\Business\Model\Translator\DataTranslatorInterface
     */
    private $dataTranslator;

    /**
     * Processor constructor.
     *
     * @param \Xervice\Processor\Business\Model\Processor\ProcessConfigurationPluginCollection $processorConfigurationPluginCollection
     * @param \Xervice\Validator\Business\ValidatorFacade $validatorFacade
     * @param \Xervice\Processor\Business\Model\Hydrator\DataHydratorInterface $dataHydrator
     * @param \Xervice\Processor\Business\Model\Translator\DataTranslatorInterface $dataTranslator
     */
    public function __construct(
        ProcessConfigurationPluginCollection $processorConfigurationPluginCollection,
        ValidatorFacade $validatorFacade,
        DataHydratorInterface $dataHydrator,
        DataTranslatorInterface $dataTranslator
    ) {
        $this->processorConfigurationPluginCollection = $processorConfigurationPluginCollection;
        $this->validatorFacade = $validatorFacade;
        $this->dataHydrator = $dataHydrator;
        $this->dataTranslator = $dataTranslator;
    }

    /**
     * @param \DataProvider\ProcessRunDataProvider $runDataProvider
     *
     * @throws \Xervice\Processor\Business\Exception\ProcessNotFoundException
     */
    public function process(ProcessRunDataProvider $runDataProvider): void
    {
        $process = $this->getProcessByName($runDataProvider->getName());

        $inputHandler = $process->getInputHandler();
        $outputHandler = $process->getOutputHandler();

        $inputHandler->init($runDataProvider);
        $outputHandler->init($runDataProvider);

        try {
            while (!$inputHandler->eof()) {
                $payload = $inputHandler->read();

                $payload = $this->processData($payload, $process);

                $outputHandler->write($payload);
            }
        }
        catch (ValidationException $validationException) {
            throw new ProcessException("Data are invalid. Validation is failed", 0, $validationException);
        }
        finally {
            $inputHandler->close();
            $outputHandler->close();
        }
    }

    /**
     * @param string $processName
     *
     * @return \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface
     * @throws \Xervice\Processor\Business\Exception\ProcessNotFoundException
     */
    protected function getProcessByName(string $processName): ProcessConfigurationPluginInterface
    {
        foreach ($this->processorConfigurationPluginCollection as $configurationPlugin) {
            if ($configurationPlugin->getProcessName() === $processName) {
                return $configurationPlugin;
            }
        }

        $exceptionMessage = sprintf(
            'No process found with name %s',
            $processName
        );

        throw new ProcessNotFoundException($exceptionMessage);
    }

    /**
     * @param array $payload
     * @param \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface $process
     *
     * @return array
     * @throws \Xervice\Validator\Business\Exception\ValidationException
     */
    protected function processData(array $payload, ProcessConfigurationPluginInterface $process): array
    {
        $this->validatorFacade->validate(
            $payload,
            $process->getValidatorConfigurationPlugins()
        );

        $payload = $this->dataHydrator->hydrate(
            $payload,
            $process->getHydratorPlugins()
        );

        $payload = $this->dataTranslator->translate(
            $payload,
            $process->getTranslatorPlugins()
        );

        return $process->process($payload);
    }
}