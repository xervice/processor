<?php
declare(strict_types=1);

namespace Xervice\Processor\Business;


use DataProvider\ProcessRunDataProvider;
use Xervice\Core\Business\Model\Facade\AbstractFacade;

/**
 * @method \Xervice\Processor\Business\ProcessorBusinessFactory getFactory()
 * @method \Xervice\Processor\ProcessorConfig getConfig()
 */
class ProcessorFacade extends AbstractFacade
{
    /**
     * @param \DataProvider\ProcessRunDataProvider $runDataProvider
     */
    public function runProcess(ProcessRunDataProvider $runDataProvider): void
    {
        $this->getFactory()
            ->createProcessor()
            ->process($runDataProvider);
    }
}