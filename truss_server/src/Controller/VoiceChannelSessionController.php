<?php

namespace App\Controller;

use App\Entity\VoiceChannelSession;
use App\Form\VoiceChannelSessionType;
use App\Repository\VoiceChannelSessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/voice/channel/session')]
class VoiceChannelSessionController extends AbstractController
{
    #[Route('/', name: 'app_voice_channel_session_index', methods: ['GET'])]
    public function index(VoiceChannelSessionRepository $voiceChannelSessionRepository): Response
    {
        return $this->render('voice_channel_session/index.html.twig', [
            'voice_channel_sessions' => $voiceChannelSessionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_voice_channel_session_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiceChannelSession = new VoiceChannelSession();
        $form = $this->createForm(VoiceChannelSessionType::class, $voiceChannelSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiceChannelSession);
            $entityManager->flush();

            return $this->redirectToRoute('app_voice_channel_session_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voice_channel_session/new.html.twig', [
            'voice_channel_session' => $voiceChannelSession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voice_channel_session_show', methods: ['GET'])]
    public function show(VoiceChannelSession $voiceChannelSession): Response
    {
        return $this->render('voice_channel_session/show.html.twig', [
            'voice_channel_session' => $voiceChannelSession,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voice_channel_session_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VoiceChannelSession $voiceChannelSession, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoiceChannelSessionType::class, $voiceChannelSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voice_channel_session_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voice_channel_session/edit.html.twig', [
            'voice_channel_session' => $voiceChannelSession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voice_channel_session_delete', methods: ['POST'])]
    public function delete(Request $request, VoiceChannelSession $voiceChannelSession, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiceChannelSession->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voiceChannelSession);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voice_channel_session_index', [], Response::HTTP_SEE_OTHER);
    }
}
