<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $f1 = new Food();
        $f1 ->setName('Carrot')
            ->setCalories(36)
            ->setPrice(1.80)
            ->setImage('food/carrot.png')
            ->setProtein(0.77)
            ->setCarbohydrates(6.45)
            ->setFats(0.26);
        $manager->persist($f1);

        $f2 = new Food();
        $f2 ->setName('Potato')
            ->setCalories(80)
            ->setPrice(1.50)
            ->setImage('food/potato.jpg')
            ->setProtein(1.80)
            ->setCarbohydrates(16.7)
            ->setFats(0.34);
        $manager->persist($f2);

        $f3 = new Food();
        $f3 ->setName('Tomato')
            ->setCalories(18)
            ->setPrice(2.30)
            ->setImage('food/tomato.png')
            ->setProtein(0.86)
            ->setCarbohydrates(2.26)
            ->setFats(0.24);
        $manager->persist($f3);

        $f4 = new Food();
        $f4 ->setName('Apple')
            ->setCalories(52)
            ->setPrice(2.35)
            ->setImage('food/apple.png')
            ->setProtein(0.25)
            ->setCarbohydrates(11.6)
            ->setFats(0.25);
        $manager->persist($f4);
        
        $manager->flush();
    }
}
