<?php

namespace Geekhub\GeekBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Geekhub\GeekBundle\Entity\Article;
use Geekhub\GeekBundle\Entity\Comment;


class LoadArticleData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i <= 25; $i++) {
            $article = new Article();
            $article->setTitle('Article Title');
            $article->setText(
              "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            );

            for ($n = 0; $n <= 25; $n++) {
                $comment = new Comment();
                $comment->setArticle($article);
                $comment->setBody('some comment');
                $comment->setMail('example@mail.com');
                $manager->persist($comment);
            }
            
            $manager->persist($article);
        }
        $manager->flush();
    }
}
