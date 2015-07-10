<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard;

use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as BaseScriptHandler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Composer\Script\CommandEvent;

/**
 * Extensions to Symfony's standard composer hooks.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ScriptHandler extends BaseScriptHandler
{
    public static function showMigrationStatus(CommandEvent $event)
    {
        $options = static::getOptions($event);
        $consoleDir = static::getConsoleDir($event, 'show migration status');

        static::executeCommand($event, $consoleDir, 'doctrine:migrations:status');
    }
}
