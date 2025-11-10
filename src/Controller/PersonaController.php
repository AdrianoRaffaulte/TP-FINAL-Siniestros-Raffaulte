<?php
namespace App\Controller;

use App\Entity\Persona;
use App\Form\PersonaType;
use App\Repository\PersonaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/persona')]
class PersonaController extends AbstractController
{
    #[Route('/', name: 'persona_index', methods: ['GET'])]
    public function index(PersonaRepository $personaRepository): Response
    {
        return $this->render('persona/index.html.twig', [
            'personas' => $personaRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')] //  solo admin puede agregar
    #[Route('/new', name: 'persona_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $persona = new Persona();
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($persona);
            $em->flush();

            return $this->redirectToRoute('persona_index');
        }

        return $this->render('persona/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'persona_show', methods: ['GET'])]
    public function show(Persona $persona): Response
    {
        return $this->render('persona/show.html.twig', [
            'persona' => $persona,
        ]);
    }

    
    //  Editar persona
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'persona_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Persona $persona, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('persona_index');
        }

        return $this->render('persona/edit.html.twig', [
            'form' => $form->createView(),
            'persona' => $persona,
        ]);
    }

    //  Eliminar persona
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/delete', name: 'persona_delete', methods: ['POST'])]
    public function delete(Request $request, Persona $persona, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$persona->getId(), $request->request->get('_token'))) {
            $em->remove($persona);
            $em->flush();
        }

        return $this->redirectToRoute('persona_index');
    }
}
