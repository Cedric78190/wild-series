<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM = [
        'Breaking-Break',
        'The Wire',
        'Dexter',
        'Walkin Dead',
    ];
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::PROGRAM as $key => $programName) {
            $program = new Program();
            $program->setTitle($programName);
            $program->setSynopsis('Des zombies envahissent la terre');
            $program->setCategory($this->getReference('category_Action'));
            $manager->persist($program);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }
}
