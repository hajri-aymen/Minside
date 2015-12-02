<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $users = $this->getDoctrine()->getRepository("UserBundle:User")->findAll();
        return $this->render('UserBundle:Default:list.html.twig', array(
            'users' => $users
        ));
    }
}
