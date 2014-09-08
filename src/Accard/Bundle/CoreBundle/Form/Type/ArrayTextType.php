<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Accard\Bundle\CoreBundle\Form\DataTransformer\ArrayTextTransformer;

/**
 * Array text form type.
 *
 * Allows a comma-separated field to be converted to an array.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ArrayTextType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new ArrayTextTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'accard_array_text';
    }
}
