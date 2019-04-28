<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Processor;

use DataProvider\ProcessRunDataProvider;

interface ProcessorInterface
{
    /**
     * @param \DataProvider\ProcessRunDataProvider $runDataProvider
     *
     * @throws \Xervice\Processor\Business\Exception\ProcessNotFoundException
     */
    public function process(ProcessRunDataProvider $runDataProvider): void;
}