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

use DateTime;
use Accard\Bundle\ImportBundle\Model\ImportInterface;

/**
 * Importer summary.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImporterView implements ImporterViewInterface
{
    /**
     * Importer name.
     *
     * @var string
     */
    private $name;

    /**
     * Importer run count.
     *
     * @var integer
     */
    private $runs;

    /**
     * Last importer run date.
     *
     * @var DateTime
     */
    private $latestRunDate;

    /**
     * Last importer run length.
     *
     * @var float
     */
    private $latestRunTime;

    /**
     * Average importer run time.
     *
     * @var float
     */
    private $averageRunTime;


    /**
     * Constructor.
     *
     * @param ImporterInterface $importer
     */
    public function __construct(ImporterInterface $importer)
    {
        $name = $importer->getName();
        $repo = $importer->getBuilder()->getImportRepository();
        $imports = $repo->getAllFor($name);

        $this->name = $name;
        $this->runs = count($imports);

        if (isset($imports[0])) {
            $this->latestRunDate = date('c', round($imports[0]->getStartTimestamp()));
            $this->latestRunTime = $imports[0]->getEndTimestamp() - $imports[0]->getStartTimestamp();

            $times = array();
            foreach ($imports as $import) {
                $times[] = $import->getEndTimestamp() - $import->getStartTimestamp();
            }

            $this->averageRunTime = array_sum($times)/count($times);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getRuns()
    {
        return $this->runs;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestRunDate()
    {
        return $this->latestRunDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestRunTime()
    {
        return $this->latestRunTime;
    }

    /**
     * {@inheritdoc}
     */
    public function getaverageRunTime()
    {
        return $this->averageRunTime;
    }
}
