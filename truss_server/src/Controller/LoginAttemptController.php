<?php

namespace App\Controller;

use App\Entity\LoginAttempt;
use App\Form\LoginAttemptType;
use App\Repository\LoginAttemptRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/login/attempt')]
class LoginAttemptController extends AbstractController
{
    #[Route('/', name: 'app_login_attempt_index', methods: ['GET'])]
    public function index(LoginAttemptRepository $loginAttemptRepository): Response
    {
        return $this->render('login_attempt/index.html.twig', [
            'login_attempts' => $loginAttemptRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_login_attempt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $loginAttempt = new LoginAttempt();
        $form = $this->createForm(LoginAttemptType::class, $loginAttempt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($loginAttempt);
            $entityManager->flush();

            return $this->redirectToRoute('app_login_attempt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('login_attempt/new.html.twig', [
            'login_attempt' => $loginAttempt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_login_attempt_show', methods: ['GET'])]
    public function show(LoginAttempt $loginAttempt): Response
    {
        return $this->render('login_attempt/show.html.twig', [
            'login_attempt' => $loginAttempt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_login_attempt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LoginAttempt $loginAttempt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LoginAttemptType::class, $loginAttempt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_login_attempt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('login_attempt/edit.html.twig', [
            'login_attempt' => $loginAttempt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_login_attempt_delete', methods: ['POST'])]
    public function delete(Request $request, LoginAttempt $loginAttempt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$loginAttempt->getId(), $request->request->get('_token'))) {
            $entityManager->remove($loginAttempt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_login_attempt_index', [], Response::HTTP_SEE_OTHER);
    }
}
