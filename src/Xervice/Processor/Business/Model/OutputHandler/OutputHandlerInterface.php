<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\OutputHandler;


use DataProvider\ProcessRunDataProvider;

interface OutputHandlerInterface
{
    /**
     * @param \DataProvider\ProcessRunDataProvider $runDataProvider
     */
    public function init(ProcessRunDataProvider $runDataProvider): void;

    /**
     * @param array $data
     */
    public function write(array $data): void;

    public function close(): void;
}