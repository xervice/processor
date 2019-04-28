<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\OutputHandler;


use DataProvider\ProcessRunDataProvider;
use Xervice\Processor\Business\Exception\ProcessException;

class RawJsonFileOutputHandler implements OutputHandlerInterface
{
    /**
     * @var resource
     */
    private $handler;

    /**
     * @param \DataProvider\ProcessRunDataProvider $runDataProvider
     *
     * @throws \Xervice\Processor\Business\Exception\ProcessException
     */
    public function init(ProcessRunDataProvider $runDataProvider): void
    {
        $this->handler = fopen($runDataProvider, 'w');
        $this->validateHandler();
    }

    /**
     * @param array $data
     */
    public function write(array $data): void
    {
        fwrite($this->handler, json_encode($data));
    }

    public function close(): void
    {
        fclose($this->handler);
    }

    protected function validateHandler(): void
    {
        if (!$this->handler) {
            throw new ProcessException('Output file isn\'t writeable');
        }
    }

}