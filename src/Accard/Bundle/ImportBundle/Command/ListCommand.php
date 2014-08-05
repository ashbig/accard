<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * List importers command.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ListCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName("accard:import:list")
            ->setDescription("List all registered importers.")
            ->addOption("summaries", null, InputOption::VALUE_NONE, "Show importer summary.")
            ->setHelp('Write help')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $registry = $container->get('accard.import.importer_registry');
        $analyzer = $container->get('accard.import.analyzer');
        $showSummaries = $input->getOption('summaries');

        $output->writeln('<comment>Listing all registered importers:</comment>');

        foreach ($registry->getImporters() as $importer) {
            $output->write(sprintf('  <info>%s</info>', $importer->getName()));
            if ($showSummaries) {
                $summary = $analyzer->getSummary($importer->getName());
                $output->writeln(':');
                $output->writeln(sprintf('    # of runs: %d', $summary->getRuns()));
                $lastRun = $summary->getLatestRunDate();
                $output->writeln(sprintf('    Last ran on: %s', $lastRun ? $lastRun->format('m/d/Y \a\t g:ia') : 'never'));
                $output->writeln(sprintf('    Avg. run time: %d seconds', $summary->getAverageRunTime()));
                $output->writeln(sprintf('    Time for last run: %d seconds', $summary->getLatestRunTime()));
            }
            $output->writeln('');
        }
    }
}
