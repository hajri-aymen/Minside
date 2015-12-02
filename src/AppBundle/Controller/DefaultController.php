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

//        $guzzleService =  $this->container->get('guzzle.client');
//        $url = 'http://demo0106089.mockable.io/ats_api';
//        $guzzleService->get($url);
//        $request = $guzzleService->get($url);
//        $response = $request->send()->json();
//dump($response);die;
          $users = $this->getDoctrine()->getRepository("UserBundle:User")->findAll();
//        return $this->render('default/index.html.twig', array('response' => $response
        return $this->render('UserBundle:Default:list.html.twig', array('users' => $users
        ));
    }
}
