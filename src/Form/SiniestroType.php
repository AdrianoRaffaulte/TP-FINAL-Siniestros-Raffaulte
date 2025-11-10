<?php
namespace App\Form;

use App\Entity\Siniestro;
use App\Entity\Clima;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiniestroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateType::class, ['widget' => 'single_text'])
            ->add('hora', TimeType::class, ['widget' => 'single_text'])
            ->add('clima', EntityType::class, [
                'class' => Clima::class,
                'choice_label' => 'descripcion',
                'placeholder' => 'Seleccione el clima',
                'required' => false,
            ])
            ->add('obs', TextareaType::class, [
                'label' => 'Observaciones',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Siniestro::class,
        ]);
    }
}
