<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 19/11/18
 * Time: 11:45
 */

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class ArticleFixtures extends Fixture implements DependentFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        $key = 0;

        for ($i = 1; $i <= 50; $i++) {
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent($faker->text);

            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_'.rand(0,4)));

        }
            $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}