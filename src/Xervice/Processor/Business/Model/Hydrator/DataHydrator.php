<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Hydrator;


use Xervice\ArrayHandler\Business\ArrayHandlerFacade;
use Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface;

class DataHydrator implements DataHydratorInterface
{
    /**
     * @var \Xervice\ArrayHandler\Business\ArrayHandlerFacade
     */
    private $arrayHandlerFacade;

    /**
     * @var \Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface
     */
    private $hydrateFieldHandler;

    /**
     * DataHydrator constructor.
     *
     * @param \Xervice\ArrayHandler\Business\ArrayHandlerFacade $arrayHandlerFacade
     */
    public function __construct(ArrayHandlerFacade $arrayHandlerFacade, FieldHandlerPluginInterface $hydrateFieldHandler)
    {
        $this->arrayHandlerFacade = $arrayHandlerFacade;
        $this->hydrateFieldHandler = $hydrateFieldHandler;
    }

    /**
     * @param array $data
     * @param \Xervice\Processor\Business\Dependency\ProcessHydratorPluginInterface[] $hydratorConfigPlugins
     *
     * @return array
     */
    public function hydrate(array $data, array $hydratorConfigPlugins): array
    {
        foreach ($hydratorConfigPlugins as $hydratorConfigPlugin) {
            $data = $this->arrayHandlerFacade->handleArray(
                $this->hydrateFieldHandler,
                $data,
                $hydratorConfigPlugin->getHydratorConfiguration()
            );
        }

        return $data;
    }
}