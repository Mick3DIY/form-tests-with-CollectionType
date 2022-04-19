<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class UserFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $names = ['Tommy', 'Pam', 'John', 'Angy', 'Suzan'];
        //App. Users
        foreach ($names as $name) {
            $rdInt = random_int(2, 20);
            $user = new User();
            $user->setUsername($name . $rdInt)
                ->setEmail($name . $rdInt . '@example.net')
                ->setRoles([User::USER_DEFAULT, User::USER_ADMIN_APP])
                ->setPassword('PassW0rd');
            $manager->persist($user);
        }
        //Simple User
        $user = new User();
        $user->setUsername('simple-user')
            ->setEmail('user' . $rdInt . '@example.com')
            ->setPassword('PasSW0rd');
        $manager->persist($user);
        $manager->flush();
    }
}
