<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Import;

use BadMethodCallException;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Accard\Bundle\ImportBundle\ImportEvents;
use Accard\Bundle\ImportBundle\Event\PreBuilderEvent;
use Accard\Bundle\ImportBundle\Event\PostBuilderEvent;
use Accard\Bundle\ImportBundle\Repository\ImportRepositoryInterface;
use Accard\Bundle\ImportBundle\Repository\RecordRepositoryInterface;
use Accard\Bundle\ImportBundle\Model\ImportInterface;
use Accard\Bundle\ImportBundle\Model\Import;
use Accard\Bundle\ImportBundle\Exception\BuilderNotCreatedException;

/**
 * Accard import builder factory.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportBuilderFactory
{
    /**
     * Object manager.
     *
     * @var ObjectManager
     */
    protected $manager;

    /**
     * Import repository.
     *
     * @var ImportRepositoryInterface
     */
    protected $importRepository;

    /**
     * Record repository.
     *
     * @var RecordRepositoryInterface
     */
    protected $recordRepository;

    /**
     * Event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructor.
     *
     * @param ObjectManager $manager
     * @param ImportInterface|null $import
     */
    public function __construct(ObjectManager $manager,
                                ImportRepositoryInterface $importRepository,
                                RecordRepositoryInterface $recordRepository,
                                EventDispatcherInterface $eventDispatcher)
    {
        $this->manager = $manager;
        $this->importRepository = $importRepository;
        $this->recordRepository = $recordRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Create new import builder.
     *
     * @param ImporterResolverInterface $resolver
     * @param RecordConverterInterface $converter
     * @param ImportInterface|null $import
     */
    public function create(ImporterResolverInterface $resolver,
                           RecordConverterInterface $converter,
                           ImportInterface $import = null)
    {
        $event = new PreBuilderEvent(
            $this->manager,
            $this->importRepository,
            $this->recordRepository,
            $resolver,
            $converter,
            $import
        );

        $this->eventDispatcher->dispatch(ImportEvents::PRE_BUILDER, $event);

        if (!$event->getBuilder()) {
            throw new BuilderNotCreatedException();
        }

        $event = new PostBuilderEvent($event->getBuilder());
        $this->eventDispatcher->dispatch(ImportEvents::POST_BUILDER, $event);

        return $event->getBuilder();
    }
}
