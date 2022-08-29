<?php 

namespace App\Form;

use App\Entity\Igrejas;
use Doctrine\Common\Annotations\Annotation\Enum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MembrosType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("nome", TextType::class, ['label' => 'Nome Membro'])
            ->add("cpf", TextType::class, ['label' => "CPF Membro"])
            ->add("data_nascimento", TextType::class, ['label' => 'Data Nascimento Membro'])
            ->add("email", TextType::class, ['label' => 'Email Membro'])
            ->add("telefone", TextType::class, ['label' => 'Telefone Membro'])
            ->add("logradouro", TextType::class, ['label' => 'Logradouro Membro'])
            ->add("cidade", TextType::class, ['label' => 'Cidade Membro'])
            ->add("estado", TextType::class, ['label' => 'Estado Membro'])
            ->add("igreja", EntityType::class, [
                                                'class' => Igrejas::class,
                                                'choice_label' => 'nome',
                                                'label' => 'Igreja: '])
            ->add("Salvar", SubmitType::class);
    }
}
