<?php

namespace App\DataFixtures;

use App\Entity\Food;
use App\Entity\Type;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $t1 = new Type();
        $t1->setFieldName('Fruits')
            ->setImage('fruits.jpg');
        $manager->persist($t1);
        $t2 = new Type();
        $t2->setFieldName('Vegetables')
            ->setImage('vegetables.jpg');
        $manager->persist($t2);
        // $product = new Product();
        // $manager->persist($product);
        $foodRepository = $manager->getRepository(Food::class);
        $f1 = $foodRepository->findOneBy(["name" => "Carrot"]);
        $f1->setType($t2);
        $manager->persist($f1);

        $f2 = $foodRepository->findOneBy(["name" => "Potato"]);
        $f2->setType($t2);
        $manager->persist($f2);

        $f3 = $foodRepository->findOneBy(["name" => "Tomato"]);
        $f3->setType($t2);
        $manager->persist($f3);

        $f4 = $foodRepository->findOneBy(["name" => "Apple"]);
        $f4->setType($t1);
        $manager->persist($f4);

        $f5 = $foodRepository->findOneBy(["name" => "Lime"]);
        $f5->setType($t1);
        $manager->persist($f5);

        $f6 = $foodRepository->findOneBy(["name" => "Cherry"]);
        $f6->setType($t1);
        $manager->persist($f6);

        $f7 = $foodRepository->findOneBy(["name" => "Leek"]);
        $f7->setType($t2);
        $manager->persist($f7);

        $manager->flush();
    }
}
