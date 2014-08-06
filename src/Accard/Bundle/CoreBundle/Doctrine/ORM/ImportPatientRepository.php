<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\CoreBundle\Doctrine\ORM;

use Accard\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * Accard import patient repository.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportPatientRepository extends EntityRepository
{
    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'import_patient';
    }
}
