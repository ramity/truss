<?php

namespace App\Controller;

use App\Entity\Server;
use App\Form\ServerType;
use App\Repository\ServerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/server')]
class ServerController extends AbstractController
{
    #[Route('/', name: 'app_server_index', methods: ['GET'])]
    public function index(ServerRepository $serverRepository): Response
    {
        return $this->render('server/index.html.twig', [
            'servers' => $serverRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_server_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $server = new Server();
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($server);
            $entityManager->flush();

            return $this->redirectToRoute('app_server_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/new.html.twig', [
            'server' => $server,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_server_show', methods: ['GET'])]
    public function show(Server $server): Response
    {
        return $this->render('server/show.html.twig', [
            'server' => $server,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_server_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Server $server, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_server_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/edit.html.twig', [
            'server' => $server,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_server_delete', methods: ['POST'])]
    public function delete(Request $request, Server $server, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$server->getId(), $request->request->get('_token'))) {
            $entityManager->remove($server);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_server_index', [], Response::HTTP_SEE_OTHER);
    }
}
