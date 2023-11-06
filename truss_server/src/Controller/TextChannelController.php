<?php

namespace App\Controller;

use App\Entity\TextChannel;
use App\Form\TextChannelType;
use App\Repository\TextChannelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/channels/text')]
class TextChannelController extends AbstractController
{
    #[Route('/', name: 'app_text_channel_index', methods: ['GET'])]
    public function index(TextChannelRepository $textChannelRepository): Response
    {
        return $this->render('text_channel/index.html.twig', [
            'text_channels' => $textChannelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_text_channel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $textChannel = new TextChannel();
        $form = $this->createForm(TextChannelType::class, $textChannel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($textChannel);
            $entityManager->flush();

            return $this->redirectToRoute('app_text_channel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('text_channel/new.html.twig', [
            'text_channel' => $textChannel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_text_channel_show', methods: ['GET'])]
    public function show(TextChannel $textChannel): Response
    {
        return $this->render('text_channel/show.html.twig', [
            'text_channel' => $textChannel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_text_channel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TextChannel $textChannel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TextChannelType::class, $textChannel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_text_channel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('text_channel/edit.html.twig', [
            'text_channel' => $textChannel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_text_channel_delete', methods: ['POST'])]
    public function delete(Request $request, TextChannel $textChannel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$textChannel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($textChannel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_text_channel_index', [], Response::HTTP_SEE_OTHER);
    }
}
