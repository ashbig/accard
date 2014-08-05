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
 * Import command.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('accard:import:run')
            ->setDescription('Imports domain resources.')
            ->addArgument('importer', InputArgument::IS_ARRAY, 'Importer to run.')
            ->addOption('all', null, InputOption::VALUE_NONE, 'Run all importers.')
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Run without persisting.')
            ->setHelp('Write help')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $manager = $container->get('accard.import.manager');
        $registry = $container->get('accard.import.importer_registry');
        $om = $container->get('accard.manager.import');

        $all = $input->getOption('all');
        $dry = $input->getOption('dry-run');
        $importers = $all ? $registry->getImporters()->getKeys() : $input->getArgument('importer');

        // We should remove the SQL logger, it causes HUGE memory problems.
        $om->getConnection()->getConfiguration()->setSQLLogger(null);

        if ($all) {
            $output->writeln('<info>Running all importers.</info');
        }

        if ($dry) {
            $output->writeln('<info>Performing dry run.</info>');
        }

        $om->transactional(function($om) use ($manager, $importers, $dry, $output) {
            foreach ($importers as $importer) {
                $output->writeln(sprintf('<comment>Running %s importer.</comment>', $importer));
                $manager->run($importer, false);
                if (!$dry) {
                    $manager->save();
                }
            }
        });

        $output->writeln(sprintf('<info>Successfully ran %s.</info>', implode(', ', $importers)));
    }
}
