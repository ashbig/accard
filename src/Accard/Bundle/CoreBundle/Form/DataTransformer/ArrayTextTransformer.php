<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\CoreBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Array to text data transformer.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ArrayTextTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($array)
    {
        if (!$array) {
            $array = array();
        }

        return implode(', ', $array);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($string)
    {
        if (!$string) {
            $string = '';
        }

        return array_filter(array_map('trim', explode(',', $string)));
    }
}
