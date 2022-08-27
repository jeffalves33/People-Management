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
            ->add("nomeIgreja", TextType::class, ['label' => 'Nome Igreja'])
            ->add("enderecoIgreja", TextType::class, ['label' => 'Endereco Igreja'])
            ->add("websiteIgreja", TextType::class, ['label' => 'WebSite Igreja'])
            ->add("fotoIgreja", TextType::class, ['label' => 'Foto Igreja'])
            ->add("Salvar", SubmitType::class);
    }
}