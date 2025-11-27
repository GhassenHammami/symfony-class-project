<?php
namespace App\DataFixtures;

use App\Entity\Candidature;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CandidatureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $candidatures = [
            [
                'candidat' => 'Alice Martin',
                'contenu' => 'Je suis passionnée par le développement web et j’ai 3 ans d’expérience en PHP.',
            ],
            [
                'candidat' => 'Jean Dupont',
                'contenu' => 'Chef de projet digital avec 5 ans d’expérience dans la gestion d’équipes agiles.',
            ],
            [
                'candidat' => 'Sophie Bernard',
                'contenu' => 'Designer UX/UI créative, spécialisée dans les interfaces mobiles.',
            ]
        ];
        $jobs = $manager->getRepository(Job::class)->findAll();
        if (empty($jobs)) {
            throw new \Exception('No jobs found. Please load JobFixtures first.');
        }
        $i = 0;
        foreach ($candidatures as $candData) {
            $candidature = new Candidature();
            $candidature->setCandidat($candData['candidat']);
            $candidature->setContenu($candData['contenu']);
            $candidature->setDate(new \DateTime());
            $candidature->setJob($jobs[$i % count($jobs)]);
            $manager->persist($candidature);
            $i++;
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [JobFixtures::class];
    }
}
