<?php
namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $images = [
            [
                'url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80',
                'alt' => 'Mountain Lake View'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80',
                'alt' => 'Forest Path in Autumn'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80',
                'alt' => 'City Skyline at Night'
            ]
        ];
        foreach ($images as $imgData) {
            $image = new Image();
            $image->setUrl($imgData['url']);
            $image->setAlt($imgData['alt']);
            $manager->persist($image);
        }
        $manager->flush();
    }
}
