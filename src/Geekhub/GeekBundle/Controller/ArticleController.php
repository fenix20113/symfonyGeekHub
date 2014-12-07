<?php

namespace Geekhub\GeekBundle\Controller;

use Geekhub\GeekBundle\Entity\Comment;
use Geekhub\GeekBundle\Form\Type\ArticleType;
use Geekhub\GeekBundle\Form\Type\CommentType;
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('_articles'));
        }

        return $this->render("GeekhubGeekBundle:Articles:edit_article.html.twig" , [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function updateAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository('GeekhubGeekBundle:Article');
        $article = $repository->find($id);
        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('_articles'));
        }

        return $this->render("GeekhubGeekBundle:Articles:edit_article.html.twig" , [
            'form' => $form->createView(),
        ]);

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
        $form = $this->createForm( new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
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
