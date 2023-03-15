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
use App\Factory\PartnersFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(1);
        IntroductionFactory::createMany(1);
        SectionFactory::createMany(3);
        ProjectFactory::createMany(10);
        PostFactory::createMany(15);
        CategoryFactory::createMany(10);
        PartnersFactory::createMany(10);
        $manager->flush();
    }
}
