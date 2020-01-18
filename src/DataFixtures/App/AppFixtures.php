<?php

namespace App\DataFixtures\App;

use App\Entity\Tender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class AppFixtures
 */
class AppFixtures extends Fixture implements FixtureGroupInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($x = 0; $x < 4000; $x++) {
            $tender = (new Tender())
                ->setTitle($faker->jobTitle)
                ->setDescription($faker->realText());
            $manager->persist($tender);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return ['AppFixtures'];
    }
}
