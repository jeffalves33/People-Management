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

    /**
     * @Route("/igrejas/editar{id}", name="igrejas_editar")
     */
    public function editar($id, Request $request, EntityManagerInterface $em, IgrejasRepository $igrejasRepository ) : Response {
        $mensagem = '';
        $igreja = $igrejasRepository->find($id); //return igreja pelo id
        $form = $this->createForm(IgrejasType::class, $igreja);
        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $mensagem = "Igreja atualizada com sucesso!";
        }

        $data['titulo'] = "editar igreja";
        $data['form'] = $form;
        $data['mensagem'] = $mensagem;
        return $this->renderForm('igrejas/form.html.twig', $data);
    }

    /**
     * @Route("/igrejas/excluir{id}", name="igrejas_excluir")
     */
    public function excluir($id, EntityManagerInterface $em, IgrejasRepository $igrejasRepository) : Response {
        $igreja = $igrejasRepository->find($id);

        if(!$igreja->getMembros()){
            $em->remove($igreja); //exclui a nivel de memória
            $em->flush(); //excluir a nível de banco de dados
        }

        return $this->redirectToRoute('igrejas');
    }
}