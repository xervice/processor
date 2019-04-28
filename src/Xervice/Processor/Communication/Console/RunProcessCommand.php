<?php
declare(strict_types=1);

namespace Xervice\Processor\Communication\Console;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Business\Model\Command\AbstractCommand;

/**
 * @method \Xervice\Processor\Business\ProcessorFacade getFacade()
 */
class RunProcessCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('process:run')
            ->addOption('process', 'p', InputOption::VALUE_REQUIRED, 'Process name')
            ->addOption('output', 'o', InputOption::VALUE_REQUIRED, 'Output file')
            ->addOption('input', 'i', InputOption::VALUE_REQUIRED, 'Input file');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $processName = $input->getOption('process');
        $inputFile = $input->getOption('input');
        $outputFile = $input->getOption('output');

        //TODO: Must be implemented
    }
}