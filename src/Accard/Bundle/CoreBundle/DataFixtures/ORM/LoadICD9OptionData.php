<?php
// src/Accard/Bundle/CoreBundle/DataFixtures/ORM/LoadICD9OptionData.php

namespace Accard\Component\Behavior\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Accard\Component\Option\Model\Option;

/**
 * industry behavior industry option fixture
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */

class LoadICD9OptionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $icd9Option = new Option();
        $icd9Option->setName('icd9');
        $icd9Option->setPresentation('ICD-9');

        $manager->persist($icd9Option);
        $manager->flush();

        $this->addReference('icd9Option', $icd9Option);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}