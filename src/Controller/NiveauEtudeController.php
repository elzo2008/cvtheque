<?php

namespace App\Controller;

use App\Entity\NiveauEtude;
use App\Form\NiveauEtudeType;
use App\Repository\NiveauEtudeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/niveau/etude")
 */
class NiveauEtudeController extends AbstractController
{
    /**
     * @Route("/", name="niveau_etude_index", methods={"GET"})
     */
    public function index(NiveauEtudeRepository $niveauEtudeRepository): Response
    {
        return $this->render('niveau_etude/index.html.twig', [
            'niveau_etudes' => $niveauEtudeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="niveau_etude_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $niveauEtude = new NiveauEtude();
        $form = $this->createForm(NiveauEtudeType::class, $niveauEtude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($niveauEtude);
            $entityManager->flush();

            return $this->redirectToRoute('niveau_etude_index');
        }

        return $this->render('niveau_etude/new.html.twig', [
            'niveau_etude' => $niveauEtude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveau_etude_show", methods={"GET"})
     */
    public function show(NiveauEtude $niveauEtude): Response
    {
        return $this->render('niveau_etude/show.html.twig', [
            'niveau_etude' => $niveauEtude,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="niveau_etude_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NiveauEtude $niveauEtude): Response
    {
        $form = $this->createForm(NiveauEtudeType::class, $niveauEtude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('niveau_etude_index');
        }

        return $this->render('niveau_etude/edit.html.twig', [
            'niveau_etude' => $niveauEtude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveau_etude_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NiveauEtude $niveauEtude): Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveauEtude->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($niveauEtude);
            $entityManager->flush();
        }

        return $this->redirectToRoute('niveau_etude_index');
    }
}
