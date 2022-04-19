<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(UserRepository $repository): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_new_user')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_default');
        }
        return $this->renderForm('default/form.html.twig', [
            'controller_name' => 'DefaultController-New',
            'label_name' => 'Save',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_edit_user', requirements: ['id' => '\d+'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_default');
        }
        return $this->renderForm('default/form.html.twig', [
            'controller_name' => 'DefaultController-Edit',
            'label_name' => 'Update',
            'form' => $form,
        ]);
    }
}
