<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Dependency;


interface ProcessHydratorPluginInterface
{
    /**
     * @return array
     */
    public function getHydratorConfiguration(): array;
}