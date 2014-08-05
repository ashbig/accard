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

use Accard\Bundle\ImportBundle\Model\RecordInterface;

/**
 * Record view.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
abstract class RecordView implements RecordViewInterface
{
    /**
     * Record.
     *
     * @var RecordInterface
     */
    private $record;


    /**
     * {@inheritdoc}
     */
    public function __construct(RecordInterface $record)
    {
        $this->record = $record;
    }
}
