<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Book;
use Faker;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un objet Faker
        $faker = Faker\Factory::create('fr_FR');
        
        $category = [];
        for ($i=0; $i < 20; $i++) { 
            //Créer des objets 
            $category = new Category();
            $category->setName($faker->word());
            //persister l'objet
            $manager->persist($category);
        }
        $users = [];
        for ($i=0; $i < 10 ; $i++) { 
            $users = new User();
            $users->setEmail($faker->email());
            $users->setPassword(password_hash('password', PASSWORD_DEFAULT));
            $users->setFirstname($faker->firstname());
            $users->setLastname($faker->lastName());

            //persister l'objet
            $manager->persist($users);
        }

        for ($i=0; $i < 60; $i++) { 
            //Créer des objets 
            $book = new Book();
            $book->setTitle($faker->word());
            $book->setResume($faker->words(20, true));
            $book->setPublishAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $book->setAuthor($faker->firstname());
            //persister l'objet
            $manager->persist($book);
        }

        $manager->flush();
    }
}
