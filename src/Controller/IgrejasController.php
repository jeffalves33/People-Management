<?php

namespace App\Controller;

use App\Entity\Igrejas;
use App\Form\IgrejasType;
use App\Repository\IgrejasRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IgrejasController extends AbstractController{
    /**
     * @Route("/igrejas", name="igrejas")
     */
    public function index(IgrejasRepository $igrejasRepository) : Response {
        //buscar no bd todas as igrejas
        $data['igrejas'] = $igrejasRepository->findAll();
        $data['titulo'] = 'Gerenciar Igrejas';

        return $this->render('igrejas/index.html.twig', $data);
    }

    /**
     * @Route("/igrejas/adicionar", name="igrejas_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $em) : Response{
        $mensagem = '';
        $igreja = new Igrejas();
        $form  = $this->createForm(IgrejasType::class, $igreja);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //salvar a nova igreja no banco de dados
            $em->persist($igreja); //salvar na memória
            $em->flush();
            $mensagem = 'Igreja adicionada com sucesso';
        }

        $data['titulo'] = "adicionar nova igreja";
        $data['form'] = $form;
        $data['mensagem'] = $mensagem;
        return $this->renderForm('igrejas/form.html.twig', $data);
    }
}