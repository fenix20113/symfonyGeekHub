<?php

namespace Geekhub\GeekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticlesController
 * @package Geekhub\GeekBundle\Controller
 */
class ArticlesController extends Controller
{

    /**
     * @return Response
     */
    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository('GeekhubGeekBundle:Article');
        $articles = $repository->findAll();

        $tweets = $this->get('tweets')->getTweets();

        return $this->render('GeekhubGeekBundle:Articles:articles.html.twig', array(
                'data' => $articles,
                'tweets' => $tweets,
            )
        );
    }
}
