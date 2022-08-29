<?php 

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class IgrejasType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("nome", TextType::class, ['label' => 'Nome Igreja'])
            ->add("endereco", TextType::class, ['label' => 'Endereco Igreja'])
            ->add("website", TextType::class, ['label' => 'WebSite Igreja'])
            ->add("foto_igreja", TextType::class, ['label' => 'Foto Igreja'])
            ->add("Salvar", SubmitType::class);
    }
}