<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM = [
        [
            'title' => 'Breaking-Bad',
            'synopsys' => 'Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour réunir de l\'argent afin de subvenir aux besoins de sa famille, Walter met ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth.',
            'category' => 'category_Action',
        ],

        [
            'title' => 'The Wire',
            'synopsys' => 'Un agent aux homicides et un détective aux narcotiques collaborent afin de démanteler une opération. La criminalité dans la ville de Baltimore, à travers la vision de ceux qui la vivent au quotidien.',
            'category' => 'category_Action',
        ],

        [
            'title' => 'Naruto',
            'synopsys' => 'L\'histoire commence pendant l\'adolescence de Naruto, vers ses douze ans. Orphelin cancre et grand farceur, il fait toutes les bêtises possibles pour se faire remarquer. Son rêve : devenir le meilleur Hokage afin d\'être reconnu par les habitants de son village.',
            'category' => 'category_Animation'
        ],

        [
            'title' => 'Game of Thrones',
            'synopsys' => 'Sur le continent de Westeros, le roi Robert Baratheon gouverne le Royaume des Sept Couronnes depuis plus de dix-sept ans, à la suite de la rébellion qu\'il a menée contre le « roi fou » Aerys II Targaryen. Jon Arryn, époux de la sœur de Lady Catelyn Stark, Lady Arryn, son guide et principal conseiller, vient de s\'éteindre, et le roi part alors dans le nord du royaume demander à son vieil ami Eddard « Ned » Stark de remplacer leur regretté mentor au poste de Main du roi. Ned, seigneur suzerain du nord depuis Winterfell et de la maison Stark, est peu désireux de quitter ses terres. Mais il accepte à contre-cœur de partir pour la capitale Port-Réal avec ses deux filles, Sansa et Arya. Juste avant leur départ pour le sud, Bran, l\'un des jeunes fils d\'Eddard, est poussé de l\'une des tours de Winterfell après avoir été témoin de la liaison incestueuse entre la reine Cersei Baratheon et son frère jumeau, Jaime Lannister. Leur frère, Tyrion Lannister, surnommé « le gnome », est alors accusé du crime par Lady Catelyn Stark.',
            'category' => 'category_Fantastique',
        ],
        
        [
            'title' => 'Lost',
            'synopsys' => 'Après le crash de leur avion sur une île perdue, des survivants doivent apprendre à cohabiter et survivre dans cet environnement hostile. Bien vite, ils se rendent compte qu\'une menace semble planer sur l\'île.',
            'category' => 'category_Aventure',
        ],

        [
            'title' => 'Oz',
            'synopsys' => 'Emerald city. Quartier expérimental de la prison créé par Tim McManus qui souhaite améliorer les conditions de vie des détenus. Or, dans cet univers se recrée une société terrifiante où dominent la haine, la violence, la peur, la mort.',
            'category' => 'category_Drame',
        ]

    ];
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::PROGRAM as $key => $program_) {
            $program = new Program();
            $program->setTitle($program_['title']);
            $program->setSynopsis($program_['synopsys']);
            $program->setCategory($this->getReference($program_['category']));
            $this->addReference('program_' . $key, $program);


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
