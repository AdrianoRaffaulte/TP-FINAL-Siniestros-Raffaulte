<?php
namespace App\Form;

use App\Entity\SiniestroDetalle;
use App\Entity\Siniestro;
use App\Entity\Persona;
use App\Entity\Rol;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiniestroDetalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('siniestro', EntityType::class, [
                'class' => Siniestro::class,
                'choice_label' => 'id',
                'label' => 'Siniestro'
            ])
            ->add('persona', EntityType::class, [
                'class' => Persona::class,
                'choice_label' => fn($p) => $p->getNombre() . ' ' . $p->getApellido(),
                'label' => 'Persona'
            ])
            ->add('rol', EntityType::class, [
                'class' => Rol::class,
                'choice_label' => 'descripcion',
                'label' => 'Rol'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SiniestroDetalle::class,
        ]);
    }
}
