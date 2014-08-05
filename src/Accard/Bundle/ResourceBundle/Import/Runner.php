<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ResourceBundle\Import;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Accard\Bundle\ResourceBundle\Event\ImportEvent;
use Accard\Bundle\ResourceBundle\Import\Events;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Import runner.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Runner
{
    protected $dispatcher;
    protected $factory;
    protected $registry;
    protected $accessor;

    public function __construct(EventDispatcherInterface $dispatcher,
                                ResourceResolvingFactory $factory,
                                Registry $registry)
    {
        $this->dispatcher = $dispatcher;
        $this->factory = $factory;
        $this->registry = $registry;
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }


    public function run($importer)
    {
        if (!$importer instanceof ImporterInterface) {
            $importer = $this->registry->getImporter($importer);
        }

        $evd = $this->dispatcher;
        $subjectName = $importer->getSubject();
        $subject = $this->factory->resolveResource($subjectName, ResourceInterface::SUBJECT);
        $target = $this->factory->resolveResource('import_'.$subjectName, ResourceInterface::TARGET);
        $event = new ImportEvent($subject, $target);

        $evd->dispatch(Events::INITIALIZE, $event);
        $event->setImporter($importer);

        $evd->dispatch(Events::PRE_IMPORT, $event);

        $resolver = new OptionsResolver();
        $importer->configureResolver($resolver);
        $records = $importer->run($resolver);

        $evd->dispatch(Events::POST_IMPORT, $event);

        $event->setImporter(null);
        $evd->dispatch(Events::FINISH, $event);
    }

    public function runAll()
    {
        foreach ($this->registry->getImporters() as $name => $importer) {
            $this->run($importer);
        }
    }
}
