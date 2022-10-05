<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    private $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 30;$i++){
            $article = new Article();
            $article->setTitre($this->faker->text(50));
            $article->setContenu($this->faker->paragraphs(5, true));

            $date = new \DateTime();
            $date->modify('-'.$i.' days');

            $article->setDateCreation($date);

            $this->addReference('article-' . $i, $article);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
