<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Dependency;


interface ProcessTranslationPluginInterface
{
    /**
     * @return array
     */
    public function getTranslationConfiguration(): array;
}