<?php

namespace App\Controller;

use App\Entity\SituationProfessionnelle;
use App\Form\SituationProfessionnelleType;
use App\Repository\SituationProfessionnelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/situation/professionnelle")
 */
class SituationProfessionnelleController extends AbstractController
{
    /**
     * @Route("/", name="situation_professionnelle_index", methods={"GET"})
     */
    public function index(SituationProfessionnelleRepository $situationProfessionnelleRepository): Response
    {
        return $this->render('situation_professionnelle/index.html.twig', [
            'situation_professionnelles' => $situationProfessionnelleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="situation_professionnelle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $situationProfessionnelle = new SituationProfessionnelle();
        $form = $this->createForm(SituationProfessionnelleType::class, $situationProfessionnelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($situationProfessionnelle);
            $entityManager->flush();

            return $this->redirectToRoute('situation_professionnelle_index');
        }

        return $this->render('situation_professionnelle/new.html.twig', [
            'situation_professionnelle' => $situationProfessionnelle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="situation_professionnelle_show", methods={"GET"})
     */
    public function show(SituationProfessionnelle $situationProfessionnelle): Response
    {
        return $this->render('situation_professionnelle/show.html.twig', [
            'situation_professionnelle' => $situationProfessionnelle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="situation_professionnelle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SituationProfessionnelle $situationProfessionnelle): Response
    {
        $form = $this->createForm(SituationProfessionnelleType::class, $situationProfessionnelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('situation_professionnelle_index');
        }

        return $this->render('situation_professionnelle/edit.html.twig', [
            'situation_professionnelle' => $situationProfessionnelle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="situation_professionnelle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SituationProfessionnelle $situationProfessionnelle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$situationProfessionnelle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($situationProfessionnelle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('situation_professionnelle_index');
    }
}
