<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\DiagnosisBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Accard\Bundle\OptionBundle\Form\Type\OptionValueChoiceType;
use Accard\Component\Option\Provider\OptionProviderInterface;
use Accard\Component\Diagnosis\Builder\DiagnosisBuilderInterface;
use Accard\Bundle\DiagnosisBundle\Form\EventListener\DefaultDiagnosisFieldListener;

/**
 * Diagnosis form type.
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DiagnosisType extends AbstractType
{
    /**
     * Data class.
     *
     * @var string
     */
    protected $dataClass;

    /**
     * Validation groups.
     *
     * @var array
     */
    protected $validationGroups;

    /**
     * Field builder.
     *
     * @var DiagnosisBuilderInterface
     */
    protected $builder;

    /**
     * Option provider..
     *
     * @var OptionProviderInterface
     */
    protected $optionProvider;


    /**
     * Constructor.
     *
     * @param string $dataClass
     * @param array $validationGroups
     * @param OptionProviderInterface $optionProvider
     */
    public function __construct($dataClass,
                                array $validationGroups,
                                DiagnosisBuilderInterface $builder,
                                OptionProviderInterface $optionProvider)
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
        $this->builder = $builder;
        $this->optionProvider = $optionProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', 'date', array(
                'label' => 'accard.diagnosis.form.start_date',
            ))
            ->add('endDate', 'date', array(
                'label' => 'accard.diagnosis.form.end_date',
                'required' => false,
            ))
            ->add('fields', 'collection', array(
                'required'     => false,
                'type'         => 'accard_diagnosis_field_value',
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->addEventSubscriber(
                new DefaultDiagnosisFieldListener($builder->getFormFactory(), $this->builder)
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => $this->dataClass,
                'validation_groups' => $this->validationGroups
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'accard_diagnosis';
    }
}
