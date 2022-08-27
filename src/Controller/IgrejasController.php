<?php

namespace App\Controller;

use App\Entity\Igrejas;
use App\Form\IgrejasType;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IgrejasController extends AbstractController{
    /**
     * @Route("/igrejas", name="igrejas")
     */
    public function index(EntityManagerInterface $em) : Response {
        //$em é um obj que vai auxiliar a execução no banco de dados
        $igreja = new Igrejas();
        $igreja->setNome("Assembléia");
        $igreja->setEndereco("Rua do Biel");
        $igreja->setWebsite("www.Reconciliação.br");
        $igreja->setFotoIgreja("sem foto");

        try{
            $em->persist($igreja); //salva em nível de memória
            $em->flush(); //salva no banco de dados
            $msg = "Igreja cadastrada com sucesso";
        }
        catch(Exception $e){
            $msg = "Erro ao cadastrar Igreja";
        }

        return new Response("<h1" . $msg . "</h1>");
    }

    /**
     * @Route("/igrejas/adicionar", name="igrejas_adicionar")
     */
    public function adicionar() : Response{
        $form  = $this->createForm(IgrejasType::class);
        $data['titulo'] = "adicionar nova igreja";
        $data['form'] = $form;
        return $this->renderForm('igrejas/form.html.twig', $data);
    }
}