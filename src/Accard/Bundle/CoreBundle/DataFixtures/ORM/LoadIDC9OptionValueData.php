<?php
// src/Accard/Bundle/OptionBundle/Doctrine/DataFixtures/ORM/LoadOptionValueData.php

namespace Accard\Bundle\OptionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Accard\Component\Option\Model\OptionValue;

/**
 * occupation industy option value fixture.
 * 
 * @author Dylan Pierce <piercedy@upenn.edu>
 */

class LoadICD9OptionValueData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $icd9OptionValue = new OptionValue();
        $icd9OptionValue->setValue('Ac myl leuk wo achv rmsn');
        $icd9OptionValue->setOption($this->getReference('icd9Option'));

        $manager->persist($icd9OptionValue);

        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}