<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{

    public function importAction()
    {
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $url = $request->request->get('url');
            $dataType = $request->request->get('data_type');
            $content = $this->executeCommand($url, $dataType);

            return $this->render('UserBundle:Default:import.html.twig', array('content' => $content));
        }
        return $this->render('UserBundle:Default:import.html.twig', array());
    }

    private function executeCommand($url, $dataType)
    {
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'ws:exploit',
            'url' => $url,
            'dataType' => $dataType,
        ));
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return $content;
    }
}