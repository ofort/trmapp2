<?php

namespace App\Controller;

use App\Entity\Trm;
use App\Form\TrmType;
use App\Repository\TrmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/trm')]
class TrmController extends AbstractController
{
    #[Route('/', name: 'app_trm_index', methods: ['GET'])]
    public function index(TrmRepository $trmRepository): Response
    {
        return $this->render('trm/index.html.twig', [
            'trms' => $trmRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_trm_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrmRepository $trmRepository): Response
    {
        $trm = new Trm();
        $form = $this->createForm(TrmType::class, $trm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trmRepository->save($trm, true);

            return $this->redirectToRoute('app_trm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trm/new.html.twig', [
            'trm' => $trm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trm_show', methods: ['GET'])]
    public function show(Trm $trm): Response
    {
        return $this->render('trm/show.html.twig', [
            'trm' => $trm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_trm_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trm $trm, TrmRepository $trmRepository): Response
    {
        $form = $this->createForm(TrmType::class, $trm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trmRepository->save($trm, true);

            return $this->redirectToRoute('app_trm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trm/edit.html.twig', [
            'trm' => $trm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trm_delete', methods: ['POST'])]
    public function delete(Request $request, Trm $trm, TrmRepository $trmRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trm->getId(), $request->request->get('_token'))) {
            $trmRepository->remove($trm, true);
        }

        return $this->redirectToRoute('app_trm_index', [], Response::HTTP_SEE_OTHER);
    }
}
