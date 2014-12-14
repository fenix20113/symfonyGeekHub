<?php

namespace Geekhub\GeekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TweetsController
 * @package Geekhub\GeekBundle\Controller
 */
class TweetsController extends Controller
{
    /**
     * @return Response
     */
    public function showAction()
    {
        return $this->render("GeekhubGeekBundle:Twitter:tweets_sidebar.html.twig", [
            "tweets" => $this->get('tweets')->getTweets(),
        ]);
    }
}
