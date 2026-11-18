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
        
        $categories = [];
        for ($i=0; $i < 20; $i++) { 
            //Créer des objets 
            $category = new Category();
            $category->setName($faker->word());
            //persister l'objet
            $manager->persist($category);
            $categories[] = $category;
        }
        $users = [];
        for ($i=0; $i < 10 ; $i++) { 
            $user = new User();
            $user->setEmail($faker->unique()->email());
            $user->setPassword(password_hash('password', PASSWORD_DEFAULT));
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastName());
            //persister l'objet
            $manager->persist($user);
            $users[] = $user;
        }

        for ($i=0; $i < 60; $i++) { 
            //Créer des objets 
            $book = new Book();
            $book->setTitle($faker->word());
            $book->setResume($faker->words(20, true));
            $book->setPublishAt(new \DateTimeImmutable($faker->date('Y-m-d')));
            $book->setAuthor($faker->firstname());
            for ($j=0; $j < 5 ; $j++) { 
                $book->addCategory($faker->randomElement($categories));
            }
            //persister l'objet
            $manager->persist($book);
        }

        $manager->flush();
    }
}
