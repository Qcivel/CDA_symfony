<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $em
    ){}

    public function getUsers(): array
    {
        return $this->userRepository->findAll() ?? [];
    }


    public function getUserById(int $id) : ?User
    {
        return $this->userRepository->find($id);
    }

    public function editUser(): string 
    {
        $this->em->flush();

        return "L'utilisateur a été modifié ";
    }
   
}