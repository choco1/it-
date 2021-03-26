<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        $faker = Faker\Factory::create("fr_FR");




        for ($i =0; $i < 30; $i++){

            $job = new Job();
            $job->setTitle($faker->title);
            $job->setDescription($faker->text(300));
            $job->setCreatedAt(new \DateTime());


            $this->addReference('job-'.$i, $job);

            $manager->persist($job);
        }


        $manager->flush();
    }
}
