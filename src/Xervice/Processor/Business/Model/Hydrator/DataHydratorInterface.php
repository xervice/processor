<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Hydrator;

interface
DataHydratorInterface
{
    /**
     * @param array $data
     * @param \Xervice\Processor\Business\Dependency\ProcessHydratorPluginInterface[] $hydratorConfigPlugins
     *
     * @return array
     */
    public function hydrate(array $data, array $hydratorConfigPlugins): array;
}