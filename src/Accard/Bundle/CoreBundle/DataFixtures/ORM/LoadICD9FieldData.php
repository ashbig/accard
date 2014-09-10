<?php
// src/Accard/Bundle/CoreBundle/DataFixtures/ORM/LoadICD9OptionData.php

namespace Accard\Component\Behavior\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Accard\Component\Diagnosis\Model\Field;

/**
 * icd9 field fixture
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */

class LoadICD9FieldData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $icd9Field = new Field();
        $icd9Field->setName('icd9');
        $icd9Field->setPresentation('ICD-9');
        $icd9Field->setType('choice');
        $icd9Field->setOption($this->getReference('icd9Option'));

        $manager->persist($icd9Field);
        $manager->flush();

        $this->addReference('icd9Field', $icd9Field);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}