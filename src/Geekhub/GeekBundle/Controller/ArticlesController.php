<?php

namespace Geekhub\GeekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function showAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('GeekhubGeekBundle:Article');
        $articles = $repository->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
          $articles,
          $request->query->get('page', 1)/*page number*/,
          10/*limit per page*/
        );

        $tweets = $this->get('tweets')->getTweets();

        return $this->render('GeekhubGeekBundle:Articles:articles.html.twig', array(
                'data' => $pagination,
                'tweets' => $tweets,
            )
        );
    }
}
