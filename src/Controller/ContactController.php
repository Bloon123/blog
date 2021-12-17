<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository) {
        $this->contactRepository = $contactRepository;
    }

    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($form->getData());
            $manager->flush();
        }

        return $this->renderForm('contact/index.html.twig', [
            'controller_name' => 'controler',
            'contacts' => $this->contactRepository->findAll(),
            'form' => $form
        ]);
    }

    #[Route('/contact/{id}', name: 'contactId')]
    public function contactId(int $id): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'controler',
            'contact' => $this->contactRepository->find($id)
        ]);
    }


    #[Route('/contact/{city}', name: 'contactCity')]
    public function contactCity(string $city): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'zobmalin',
            'city' => $city
        ]);
    }
}
