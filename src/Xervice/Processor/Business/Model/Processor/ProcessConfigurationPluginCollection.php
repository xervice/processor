<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Processor;


use Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface;

class ProcessConfigurationPluginCollection implements \Iterator, \Countable
{
    /**
     * @var \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * Collection constructor.
     *
     * @param \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $validator) {
            $this->add($validator);
        }
    }

    /**
     * @param \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface $validator
     */
    public function add(ProcessConfigurationPluginInterface $validator): void
    {
        $this->collection[] = $validator;
    }

    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface
     */
    public function current(): ProcessConfigurationPluginInterface
    {
        return $this->collection[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->collection);
    }
}