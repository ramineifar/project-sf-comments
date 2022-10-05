<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sport = new Category();
        $sport->setName('Films');

        $sport->addArticle($this->getReference('article-1'));
        $sport->addArticle($this->getReference('article-2'));
        $sport->addArticle($this->getReference('article-3'));
        $sport->addArticle($this->getReference('article-10'));
        $sport->addArticle($this->getReference('article-15'));

        $manager->persist($sport);

        $maison = new Category();
        $maison->setName('Séries');

        $maison->addArticle($this->getReference('article-2'));
        $maison->addArticle($this->getReference('article-3'));
        $maison->addArticle($this->getReference('article-4'));
        $maison->addArticle($this->getReference('article-22'));
        $maison->addArticle($this->getReference('article-24'));
        $maison->addArticle($this->getReference('article-28'));

        $manager->persist($maison);

        $manager->flush();
    }
}
