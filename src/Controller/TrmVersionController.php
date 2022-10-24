<?php

namespace App\Controller;

use App\Entity\TrmVersion;
use App\Entity\Trm;
use App\Form\TrmVersionType;
use App\Repository\TrmVersionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/version')]
class TrmVersionController extends AbstractController
{
    #[Route('/', name: 'app_trm_version_index', methods: ['GET'])]
    public function index(TrmVersionRepository $trmVersionRepository): Response
    {
        return $this->render('trm_version/index.html.twig', [
            'trm_versions' => $trmVersionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_trm_version_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrmVersionRepository $trmVersionRepository): Response
    {
        $trmVersion = new TrmVersion();
        $form = $this->createForm(TrmVersionType::class, $trmVersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trmVersionRepository->save($trmVersion, true);

            return $this->redirectToRoute('app_trm_version_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trm_version/new.html.twig', [
            'trm_version' => $trmVersion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trm_version_show', methods: ['GET'])]
    public function show(TrmVersion $trmVersion): Response
    {
        return $this->render('trm_version/show.html.twig', [
            'trm_version' => $trmVersion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_trm_version_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrmVersion $trmVersion, TrmVersionRepository $trmVersionRepository): Response
    {
        $form = $this->createForm(TrmVersionType::class, $trmVersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trmVersionRepository->save($trmVersion, true);

            return $this->redirectToRoute('app_trm_version_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trm_version/edit.html.twig', [
            'trm_version' => $trmVersion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trm_version_delete', methods: ['POST'])]
    public function delete(Request $request, TrmVersion $trmVersion, TrmVersionRepository $trmVersionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trmVersion->getId(), $request->request->get('_token'))) {
            $trmVersionRepository->remove($trmVersion, true);
        }

        return $this->redirectToRoute('app_trm_version_index', [], Response::HTTP_SEE_OTHER);
    }
}
