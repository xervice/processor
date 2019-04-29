<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\InputHandler;


use DataProvider\ProcessRunDataProvider;
use Xervice\Processor\Business\Exception\ProcessException;

class RawJsonFileRowInputHandler implements InputHandlerInterface
{
    /**
     * @var resource
     */
    private $handler;

    /**
     * @return bool
     */
    public function eof(): bool
    {
        return feof($this->handler);
    }

    /**
     * @param \DataProvider\ProcessRunDataProvider $runDataProvider
     */
    public function init(ProcessRunDataProvider $runDataProvider): void
    {
        $this->handler = fopen($runDataProvider->getInput(), 'r');
        $this->validateHandler();
    }

    /**
     * @return array
     */
    public function read(): array
    {
        $this->eof = true;
        return json_decode(
            fgets($this->handler),
            true
        );
    }

    public function close(): void
    {
        fclose($this->handler);
    }

    /**
     * @throws \Xervice\Processor\Business\Exception\ProcessException
     */
    protected function validateHandler(): void
    {
        if (!$this->handler) {
            throw new ProcessException('Input file isn\'t readable');
        }
    }

}