<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\InputHandler;


use DataProvider\ProcessRunDataProvider;

interface InputHandlerInterface
{
    /**
     * @return bool
     */
    public function eof(): bool;

    /**
     * @param \DataProvider\ProcessRunDataProvider $runDataProvider
     */
    public function init(ProcessRunDataProvider $runDataProvider): void;

    /**
     * @return array
     */
    public function read(): array;

    public function close(): void;
}