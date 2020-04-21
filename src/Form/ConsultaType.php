<?php

namespace App\Form;

use App\Entity\Consulta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;




class ConsultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenido', ChoiceType::class, [
                'choices'  => [
                    'Si' => 1,
                    'No' => 0,
                ],
            ])
            ->add('habilidades', ChoiceType::class, [
                'multiple' => true,
                'choices'  => [
                    'Ingenio e inventiva' => 'Ingenio e inventiva',
                    'Conocimientos generales' => 'Conocimientos generales',
                    'Conocimientos de materias específicas' => 'Conocimientos de materias específicas',
                    'Claridad en redacción de soluciones' => 'Claridad en redacción de soluciones',
                    'Comprensión de la teoría' => 'Comprensión de la teoría',
                ],
            ])
            ->add('preguntas', ChoiceType::class, [
                'multiple' => true,
                'choices'  => [
                    'Cálculos rutinarios' => 'Cálculos rutinarios',
                    'Demostraciones sencillas' => 'Demostraciones sencillas',
                    'Opción múltiple' => 'Opción múltiple',
                    'Trucos ingeniosos' => 'Trucos ingeniosos',
                    'Preguntas tipo olimpiada' => 'Preguntas tipo olimpiada',
                ],
            ])
            ->add('temas', ChoiceType::class, [
                'multiple' => true,
                'choices'  => [
                    'Calculo' => 'Calculo',
                    'Álgebra lineal' => 'Álgebra lineal',
                    'Álgebra abstracta' => 'Álgebra abstracta',
                    'Combinatoria' => 'Combinatoria',
                    'Probabilidad' => 'Probabilidad',
                    'Teoría de números' => 'Teoría de números',
                    'Ecuaciones diferenciales' => 'Ecuaciones diferenciales',
                    'Geomería diferencial' => 'Geometría diferencial',
                    'Topología' => 'Topología',
                    'Física' => 'Física',
                ],
            ])
            ->add('opinion', TextareaType::class, [
                    'required'   => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consulta::class,
        ]);
    }
}
