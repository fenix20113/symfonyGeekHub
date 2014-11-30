<?php

namespace Geekhub\GeekBundle\Controller;

use Geekhub\GeekBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Geekhub\GeekBundle\Entity\Article;

/**
 * Class ArticleController
 * @package Geekhub\GeekBundle\Controller
 */
class ArticleController extends Controller
{

    /**
     * @return Response
     */
    public function createAction()
    {
        $articles = new Article();
        $articles->setTitle('post title');
        $articles->setCreated(new \DateTime(date('Y-m-d H:i:s')));
        $articles->setText("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");

        $em = $this->getDoctrine()->getManager();
        $em->persist($articles);
        $em->flush();

        return $this->redirect($this->generateUrl('_articles'));
    }


    /**
     * @param $id
     * @return Response
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('GeekhubGeekBundle:Article')->find($id);
        $em->remove($article);
        $em->flush();

        return $this->redirect($this->generateUrl('_articles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function showAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('GeekhubGeekBundle:Article');
        $article = $repository->find($id);

        $commentsRepository = $this->getDoctrine()->getRepository('GeekhubGeekBundle:Comment');
        $comments = $commentsRepository->findCommentForArticle($article);


        $comment = new Comment();
        $form = $this->createFormBuilder($comment)
            ->add('body', 'textarea', ['label' => 'Comment'])
            ->add('mail', 'text', ['label' => 'Email'])
            ->add('save', 'submit', ['label' => 'Add a comment',])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $comment->setCreated(new \DateTime(date('Y-m-d H:i:s')));
            $comment->setArticle($article);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('_article', ['id' => $id]));
        }

        return $this->render('GeekhubGeekBundle:Articles:article.html.twig', [
            'data' => $article,
            'form' => $form->createView(),
            'comments' => $comments
        ]);
    }


} 