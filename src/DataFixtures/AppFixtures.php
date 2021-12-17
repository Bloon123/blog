<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ['Titouan', 'Philibert', 'Eratosthène', 'Tibo'];

        foreach ($names as $name) {
            $contact = new Contact();
            $contact->setPrenom($name);
            $contact->setName("Zobmalin");
            $contact->setNewsletter("YES");
            $contact->setMessage("oui");
            $manager->persist($contact);
        }
        $manager->flush();
    }
}
