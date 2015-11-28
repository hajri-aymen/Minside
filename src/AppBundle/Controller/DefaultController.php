<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $guzzleService = $this->container->get('guzzle.client');
        $url = 'http://demo0106089.mockable.io/ats_api';
        $guzzleService->get($url);
        $request = $guzzleService->get($url);
        $response = $request->send()->json();

//dump($response);die;


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array('response' => $response
        ));
    }
}
