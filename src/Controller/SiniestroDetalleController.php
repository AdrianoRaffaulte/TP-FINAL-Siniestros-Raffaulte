<?php
namespace App\Controller;

use App\Entity\SiniestroDetalle;
use App\Form\SiniestroDetalleType;
use App\Repository\SiniestroDetalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/detalle')]
class SiniestroDetalleController extends AbstractController
{
    #[Route('/', name: 'detalle_index', methods: ['GET'])]
    public function index(SiniestroDetalleRepository $detalleRepo): Response
    {
        return $this->render('detalle/index.html.twig', [
            'detalles' => $detalleRepo->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'detalle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $detalle = new SiniestroDetalle();
        $form = $this->createForm(SiniestroDetalleType::class, $detalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($detalle);
            $em->flush();
            return $this->redirectToRoute('detalle_index');
        }

        return $this->render('detalle/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'detalle_show', methods: ['GET'])]
    public function show(SiniestroDetalle $detalle): Response
    {
        return $this->render('detalle/show.html.twig', [
            'detalle' => $detalle,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'detalle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SiniestroDetalle $detalle, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SiniestroDetalleType::class, $detalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('detalle_index');
        }

        return $this->render('detalle/edit.html.twig', [
            'form' => $form->createView(),
            'detalle' => $detalle,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/delete', name: 'detalle_delete', methods: ['POST'])]
    public function delete(Request $request, SiniestroDetalle $detalle, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detalle->getId(), $request->request->get('_token'))) {
            $em->remove($detalle);
            $em->flush();
        }

        return $this->redirectToRoute('detalle_index');
    }
}
