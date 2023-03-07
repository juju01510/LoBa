<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\UserFactory;
use App\Factory\IntroductionFactory;
use App\Factory\SectionFactory;
use App\Factory\ProjectFactory;
use App\Factory\PostFactory;
use App\Factory\CategoryFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        UserFactory::createMany(1);
        IntroductionFactory::createMany(1);
        SectionFactory::createMany(3);
        ProjectFactory::createMany(10);
        Postfactory::createMany(15);
        Categoryfactory::createMany(10);
        $manager->flush();
    }
}
