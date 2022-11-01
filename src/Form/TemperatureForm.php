<?php

/**
 * Temperature Form
 *
 * PHP version 7.4
 *
 * @author Mohan Jadhav <mohan212jadhav@gmail.com>
 */

declare(strict_types=1);

namespace App\Form;

use App\Entity\MeanKineticTemperature;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\Validator\Constraints\{All, File, NotBlank, Length};

class TemperatureForm extends AbstractType
{
    /**
     * TemperatureForm constructor.
     * 
     */
    public function __construct() {}

    /**
     * Builds the Task temperature form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder 
            ->add('documents', FileType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => ['class'=> 'form-control'],
                'constraints' => [
                    new File([
                        'mimeTypes' => MeanKineticTemperature::MIMETYPES,
                        'mimeTypesMessage' => MeanKineticTemperature::MIMETYPE_MESSAGE,
                    ]),
                    new NotBlank(['message' => MeanKineticTemperature::EMPTY_MESSAGE]),
                ],
            ])
            ->add('_csrf_token', HiddenType::class, [
                'required' => true,
                'constraints' => [new NotBlank()],
            ]);
    }
}
