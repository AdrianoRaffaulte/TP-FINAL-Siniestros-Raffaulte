<?php
namespace App\Controller;

use App\Entity\Siniestro;
use App\Form\SiniestroType;
use App\Repository\SiniestroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/siniestro')]
class SiniestroController extends AbstractController
{
    #[Route('/', name: 'siniestro_index', methods: ['GET'])]
    public function index(SiniestroRepository $siniestroRepository): Response
    {
        return $this->render('siniestro/index.html.twig', [
            'siniestros' => $siniestroRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'siniestro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $siniestro = new Siniestro();
        $form = $this->createForm(SiniestroType::class, $siniestro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($siniestro);
            $em->flush();
            return $this->redirectToRoute('siniestro_index');
        }

        return $this->render('siniestro/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'siniestro_show', methods: ['GET'])]
    public function show(Siniestro $siniestro): Response
    {
        return $this->render('siniestro/show.html.twig', [
            'siniestro' => $siniestro,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'siniestro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Siniestro $siniestro, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SiniestroType::class, $siniestro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('siniestro_index');
        }

        return $this->render('siniestro/edit.html.twig', [
            'form' => $form->createView(),
            'siniestro' => $siniestro,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/delete', name: 'siniestro_delete', methods: ['POST'])]
    public function delete(Request $request, Siniestro $siniestro, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$siniestro->getId(), $request->request->get('_token'))) {
            $em->remove($siniestro);
            $em->flush();
        }

        return $this->redirectToRoute('siniestro_index');
    }
}
