<?php



namespace Geekhub\GeekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Geekhub\GeekBundle\Entity\Articles;

/**
 * Class ArticlesController
 * @package Geekhub\GeekBundle\Controller
 */
class ArticlesController extends Controller
{
    /**
     * @return Response
     */
    public function createAction()
    {
        $articles = new Articles();
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
        $article = $em->getRepository('GeekhubGeekBundle:Articles')->find($id);
        $em->remove($article);
        $em->flush();

        return $this->redirect($this->generateUrl('_articles'));
    }

    /**
     * @return Response
     */
    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository('GeekhubGeekBundle:Articles');
        $articles = $repository->findAll();

        return $this->render('GeekhubGeekBundle:Articles:articles.html.twig', array('data' => $articles));
    }
}
