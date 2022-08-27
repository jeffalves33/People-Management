<?php

namespace App\Controller;

use App\Entity\Membros;
use App\Form\MembrosType;
use App\Repository\IgrejasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembrosController extends AbstractController{
    /**
     * @Route("/membros", name="membros")
     */
    public function index(EntityManagerInterface $em, IgrejasRepository $igrejasRepository) : Response {
        //$em é um obj que vai auxiliar a execução no banco de dados
        $igreja = $igrejasRepository->find(1);
        $membro = new Membros();
        $membro->setNome("jocimar correa");
        $membro->setCpf("12345678912");
        $membro->setDataNascimento("20/20/20");
        $membro->setEmail("joci_mar@gmail.com");
        $membro->setTelefone("27998655235");
        $membro->setLogradouro("casa");
        $membro->setCidade("serra");
        $membro->setEstado("ES");
        $membro->setIgreja($igreja);
        
        try{
            $em->persist($membro); //salva em nível de memória
            $em->flush(); //salva no banco de dados
            $msg = "Produto cadastrada com sucesso";
        }
        catch(Exception $e){
            $msg = "Erro ao cadastrar Produto";
        }

        return new Response("<h1" . $msg . "</h1>");
    }

    /**
     * @Route("/membros/adicionar", name="membros_adicionar")
     */
    public function adicionar() : Response{
        $form  = $this->createForm(MembrosType::class);
        $data['titulo'] = "adicionar novo membro";
        $data['form'] = $form;
        return $this->renderForm('membros/form.html.twig', $data);
    }

}