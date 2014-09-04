<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\AttributeBundle\Form\Type;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Accard\Bundle\DiagnosisBundle\Provider\CodeGroupProvider;
/**
 * Attribute Family Cancer form type.
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
class FamilyCancerAttributeType extends AttributeType
{
    /**
     * Translator.
     *
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * code group provider.
     *
     * @var CodeGroupProvider
     */
    private $codeGroupProvider;

    /**
     * set code group provider.
     *
     * @param CodeGroupProvider
     */
    public function setCodeGroupProvider(CodeGroupProvider $codeGroupProvider)
    {
        $this->codeGroupProvider = $codeGroupProvider;
    }

    /**
     * Set translator.
     *
     * @param TranslatorInterface
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null === $this->translator) {
            throw new \LogicException('Translator must be present when constructing the family cancer attribute form type.');
        }

        if (null === $this->codeGroupProvider) {
            throw new \LogicException('Code Group must be present when constructing the family cancer attribute form type.');
        }

        $codeGroupClass = $this->codeGroupProvider->getRepository()->getClassName();
        $codeGroupChoices = $this->codeGroupProvider->getGroups();


        $builder
            ->add('familyMember', 'choice', array(
                'label'         => $this->translator->trans('accard.attribute.family_cancer.form.familyMember'),
                'required'      => true,
                'choices'           =>      array(
                    'mother'            =>      $this->translator->trans('accard.attribute.family_cancer.form.family.mother'),
                    'father'            =>      $this->translator->trans('accard.attribute.family_cancer.form.family.father'),
                    'sister'            =>      $this->translator->trans('accard.attribute.family_cancer.form.family.sister'),
                    'brother'           =>      $this->translator->trans('accard.attribute.family_cancer.form.family.brother'),
                    'grandfather'       =>      $this->translator->trans('accard.attribute.family_cancer.form.family.grandfather'),
                    'grandmother'       =>      $this->translator->trans('accard.attribute.family_cancer.form.family.grandmother'),
                    'aunt'              =>      $this->translator->trans('accard.attribute.family_cancer.form.family.aunt'),
                    'uncle'             =>      $this->translator->trans('accard.attribute.family_cancer.form.family.uncle'),
                    'cousin'            =>      $this->translator->trans('accard.attribute.family_cancer.form.family.cousin')
                )
            ))
            ->add('side', 'choice', array(
                'label'         => $this->translator->trans('accard.attribute.family_cancer.form.side'),
                'required'      => true,
                'choices'           =>      array(
                    'mother'            =>      $this->translator->trans('accard.attribute.family_cancer.form.mothers_side'),
                    'father'            =>      $this->translator->trans('accard.attribute.family_cancer.form.fathers_side')
                )
            ))
            ->add('codeGroups', 'entity', array(
                'label'         =>       'accard.attribute.family_cancer.form.code_groups',
                'class'         =>       $codeGroupClass,
                'choices'       =>       $codeGroupChoices,
                'property'      =>       'presentation',
            ))
        ;
    }


    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'accard_attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'accard_family_cancer_attribute';
    }
}
