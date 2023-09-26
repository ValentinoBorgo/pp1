<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

//practicasprof1

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 5; $i++){
            $user = new User();
            $user->setNombre("Usuario ".$i+1);
            $user->setEmail("usuario".$i."@gmail.com");
            $user->setPassword('$2y$13$ioX1mRkD2c9XB2Z0HwbJW.xZ9won/.cN18Er4hhHg1VkWHJRGkWjy');
            $manager->persist($user);   
        }
        $manager->flush();
    }
}
