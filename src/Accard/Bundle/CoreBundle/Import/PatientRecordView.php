<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\CoreBundle\Import;

use Accard\Bundle\ImportBundle\Import\RecordView;

/**
 * Patient record view.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PatientRecordView extends RecordView
{
    /**
     * {@inheritdoc}
     */
    public function getFields()
    {
        return array(
            'mrn' => 'accard.form.patient.mrn',
            'first_name' => 'accard.form.patient.first_name',
            'last_name' => 'accard.form.patient.last_name',
        );
    }
}
