<?php

namespace App\Controller;

use App\Entity\Personnages2;
use App\Form\Personnages2Type;
use App\Repository\Personnages2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personnages2')]
class Personnages2Controller extends AbstractController
{
    #[Route('/', name: 'app_personnages2_index', methods: ['GET'])]
    public function index(Personnages2Repository $personnages2Repository): Response
    {
        return $this->render('personnages2/index.html.twig', [
            'personnages2s' => $personnages2Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_personnages2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Personnages2Repository $personnages2Repository): Response
    {
        $personnages2 = new Personnages2();
        $form = $this->createForm(Personnages2Type::class, $personnages2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnages2Repository->add($personnages2);
            return $this->redirectToRoute('app_personnages2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnages2/new.html.twig', [
            'personnages2' => $personnages2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personnages2_show', methods: ['GET'])]
    public function show(Personnages2 $personnages2): Response
    {
        return $this->render('personnages2/show.html.twig', [
            'personnages2' => $personnages2,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_personnages2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Personnages2 $personnages2, Personnages2Repository $personnages2Repository): Response
    {
        $form = $this->createForm(Personnages2Type::class, $personnages2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnages2Repository->add($personnages2);
            return $this->redirectToRoute('app_personnages2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnages2/edit.html.twig', [
            'personnages2' => $personnages2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personnages2_delete', methods: ['POST'])]
    public function delete(Request $request, Personnages2 $personnages2, Personnages2Repository $personnages2Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnages2->getId(), $request->request->get('_token'))) {
            $personnages2Repository->remove($personnages2);
        }

        return $this->redirectToRoute('app_personnages2_index', [], Response::HTTP_SEE_OTHER);
    }


}
