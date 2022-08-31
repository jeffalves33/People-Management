<?php

namespace App\Controller;

use App\Entity\Membros;
use App\Form\MembrosType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MembrosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembrosController extends AbstractController{

    /**
     * @Route("/membros", name="membros")
     */
    public function index(MembrosRepository $membrosRepository) : Response {
        //buscar no bd todas os membros
        $data['membros'] = $membrosRepository->findAll();
        $data['titulo'] = 'Gerenciar Membros';

        return $this->render('membros/index.html.twig', $data);
    }

    /**
     * @Route("/membros/adicionar", name="membros_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $em) : Response{
        $mensagem = '';
        $membro = new Membros();
        $form  = $this->createForm(MembrosType::class, $membro);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //salvar um novo membro no banco de dados
            $em->persist($membro); //salvar na memória
            $em->flush();
            $mensagem = 'Membro adicionado com sucesso';
        }

        $data['titulo'] = "adicionar novo membro";
        $data['form'] = $form;
        $data['mensagem'] = $mensagem;
        return $this->renderForm('membros/form.html.twig', $data);
    }

    /**
     * @Route("/membros/editar{id}", name="membros_editar")
     */
    public function editar($id, Request $request, EntityManagerInterface $em, MembrosRepository $membrosRepository ) : Response {
        $mensagem = '';
        $membro = $membrosRepository->find($id); //return membro pelo id
        $form = $this->createForm(MembrosType::class, $membro);
        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $mensagem = "Membro atualizada com sucesso!";
        }

        $data['titulo'] = "editar membro";
        $data['form'] = $form;
        $data['mensagem'] = $mensagem;
        return $this->renderForm('membros/form.html.twig', $data);
    }

    /**
     * @Route("/membros/excluir{id}", name="membros_excluir")
     */
    public function excluir($id, EntityManagerInterface $em, MembrosRepository $membrosRepository) : Response {
        $membro = $membrosRepository->find($id);

        $em->remove($membro); //exclui a nivel de memória
        $em->flush(); //excluir a nível de banco de dados

        return $this->redirectToRoute('membros');
    }

}