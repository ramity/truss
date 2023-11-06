<?php

namespace App\Controller;

use App\Entity\VoiceChannel;
use App\Form\VoiceChannelType;
use App\Repository\VoiceChannelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/channels/voice')]
class VoiceChannelController extends AbstractController
{
    #[Route('/', name: 'app_voice_channel_index', methods: ['GET'])]
    public function index(VoiceChannelRepository $voiceChannelRepository): Response
    {
        return $this->render('voice_channel/index.html.twig', [
            'voice_channels' => $voiceChannelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_voice_channel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiceChannel = new VoiceChannel();
        $form = $this->createForm(VoiceChannelType::class, $voiceChannel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiceChannel);
            $entityManager->flush();

            return $this->redirectToRoute('app_voice_channel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voice_channel/new.html.twig', [
            'voice_channel' => $voiceChannel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voice_channel_show', methods: ['GET'])]
    public function show(VoiceChannel $voiceChannel): Response
    {
        return $this->render('voice_channel/show.html.twig', [
            'voice_channel' => $voiceChannel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voice_channel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VoiceChannel $voiceChannel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoiceChannelType::class, $voiceChannel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voice_channel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voice_channel/edit.html.twig', [
            'voice_channel' => $voiceChannel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voice_channel_delete', methods: ['POST'])]
    public function delete(Request $request, VoiceChannel $voiceChannel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiceChannel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voiceChannel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voice_channel_index', [], Response::HTTP_SEE_OTHER);
    }
}
