<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $genre = ['male', 'female'];
        for($i = 1; $i <= 50; $i++){
            $comment = new Comment();
            $comment->setContenu($this->faker->sentence(10, true) );
            $comment->setAuteur($this->faker->firstName($genre[mt_rand(0,1)]));
            $comment->setDateComment(new \DateTime('-' . random_int(1, 45).' days'));
            $comment->setArticle($this->getReference('article-' . random_int(1, 30)));

            $manager->persist($comment);
        }




        $manager->flush();
    }
}
