<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle;

/**
 * Import events.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
final class ImportEvents
{
    /**
     * The accard.import.pre_run event is thrown each time an importer is run.
     *
     * @var string
     */
    const PRE_RUN = 'accard.import.pre_run';

    /**
     * The accard.import.post_run event is thrown each time an importer is finished.
     *
     * @var string
     */
    const POST_RUN = 'accard.import.post_run';

    /**
     * The accard.import.register event is thrown each time an importer is registered.
     *
     * @var string
     */
    const REGISTER = 'accard.import.register';

    /**
     * The accard.import.pre_builder is thrown when an import builder is created.
     *
     * @var string
     */
    const PRE_BUILDER = 'accard.import.pre_builder';

    /**
     * The accard.import.post_builder is thrown when after an import builder is created.
     *
     * @var string
     */
    const POST_BUILDER = 'accard.import.post_builder';
}
