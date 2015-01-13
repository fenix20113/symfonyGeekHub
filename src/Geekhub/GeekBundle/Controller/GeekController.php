<?php


namespace Geekhub\GeekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class GeekController
 * @package Geekhub\GeekBundle\Controller
 */
class GeekController extends Controller
{

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render('GeekhubGeekBundle:Geek:index.html.twig', array('name' => $name));
    }

}
