<?php
namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jobs = [
            [
                'type' => 'Web Developer',
                'company' => 'Tech Innovators',
                'description' => 'Développement et maintenance de sites web dynamiques en PHP et Symfony.',
                'expires_at' => new \DateTimeImmutable('+30 days'),
                'email' => 'jobs@techinnovators.com'
            ],
            [
                'type' => 'Project Manager',
                'company' => 'Digital Project',
                'description' => 'Gestion de projets digitaux, coordination des équipes et suivi des livrables.',
                'expires_at' => new \DateTimeImmutable('+45 days'),
                'email' => 'recrutement@digitalproject.com'
            ],
            [
                'type' => 'UX/UI Designer',
                'company' => 'UX Studio',
                'description' => 'Conception d’expériences utilisateurs et de maquettes graphiques.',
                'expires_at' => new \DateTimeImmutable('+60 days'),
                'email' => 'contact@uxstudio.com'
            ]
        ];
        foreach ($jobs as $jobData) {
            $job = new Job();
            $job->setType($jobData['type']);
            $job->setCompany($jobData['company']);
            $job->setDescription($jobData['description']);
            $job->setExpiresAt($jobData['expires_at']);
            $job->setEmail($jobData['email']);
            $manager->persist($job);
        }
        $manager->flush();
    }
}
