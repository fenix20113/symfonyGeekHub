<?php

namespace Geekhub\GeekBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class CommentRepository
 * @package Geekhub\GeekBundle\Entity
 */
class CommentRepository extends EntityRepository
{

    /**
     * @param Article $article
     * @return array
     */
    public function findCommentForArticle( $article)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT com FROM GeekhubGeekBundle:Comment com WHERE com.article = :article_id');
        $query->setParameters([
            'article_id' => $article->getId()
        ]);
        return $query->getResult();
    }
}
