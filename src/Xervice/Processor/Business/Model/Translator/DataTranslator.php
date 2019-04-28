<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Translator;


use Xervice\ArrayHandler\Business\ArrayHandlerFacade;
use Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface;

class DataTranslator implements DataTranslatorInterface
{
    /**
     * @var \Xervice\ArrayHandler\Business\ArrayHandlerFacade
     */
    private $arrayHandlerFacade;

    /**
     * @var \Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface
     */
    private $translateFieldHandler;

    /**
     * DataTranslator constructor.
     *
     * @param \Xervice\ArrayHandler\Business\ArrayHandlerFacade $arrayHandlerFacade
     * @param \Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface $translateFieldHandler
     */
    public function __construct(ArrayHandlerFacade $arrayHandlerFacade, FieldHandlerPluginInterface $translateFieldHandler)
    {
        $this->arrayHandlerFacade = $arrayHandlerFacade;
        $this->translateFieldHandler = $translateFieldHandler;
    }

    /**
     * @param array $data
     * @param \Xervice\Processor\Business\Dependency\ProcessTranslationPluginInterface[] $translatorConfigPlugins
     *
     * @return array
     */
    public function translate(array $data, array $translatorConfigPlugins): array
    {
        foreach ($translatorConfigPlugins as $translatorConfigPlugin) {
            $data = $this->arrayHandlerFacade->handleArray(
                $this->translateFieldHandler,
                $data,
                $translatorConfigPlugin->getHydratorConfiguration()
            );
        }

        return $data;
    }
}