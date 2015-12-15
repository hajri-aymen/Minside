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

        $xml = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<user>
<_id>565ed86c60a7f7e3b7ed3820</_id>
<index>0</index>
<guid>142551b5-4cfd-4b3e-a47c-59c35010611a</guid>
<isActive>true</isActive>
<balance>$3,435.81</balance>
<picture>http://placehold.it/32x32</picture>
<age>29</age>
<eyeColor>blue</eyeColor>
<name>Sloan Grant</name>
<gender>male</gender>
<company>VOIPA</company>
<email>sloangrant@voipa.com</email>
<phone>+1 (810) 588-3116</phone>
<address>818 Madeline Court, Sutton, South Dakota, 343</address>
<about>
Consectetur culpa irure ullamco dolore duis ad qui. Fugiat ullamco ad non sint non nisi veniam cupidatat cupidatat quis. Nisi in nisi nisi magna laborum laborum aliquip occaecat et commodo et consectetur. Commodo ex dolor exercitation consectetur id deserunt dolor sunt. Occaecat laborum dolore nisi sint veniam labore anim. Reprehenderit consectetur aliqua nulla culpa commodo ullamco ex amet. Laborum est qui mollit irure cillum irure Lorem.
</about>
<registered>2014-07-24T02:25:31 -01:00</registered>
<latitude>-47.385393</latitude>
<longitude>1.581123</longitude>
<tags>adipisicing</tags>
<tags>consequat</tags>
<tags>quis</tags>
<tags>dolor</tags>
<tags>commodo</tags>
<tags>laborum</tags>
<tags>proident</tags>
<friends>
<id>0</id>
<name>Gabriela Hartman</name>
</friends>
<friends>
<id>1</id>
<name>Lydia Terrell</name>
</friends>
<friends>
<id>2</id>
<name>Reed Holloway</name>
</friends>
<greeting>Hello, Sloan Grant! You have 9 unread messages.</greeting>
<favoriteFruit>banana</favoriteFruit>
</user>
EOT;
        $users = $this->getDoctrine()->getRepository("UserBundle:User")->findAll();
        $obj = $this->get('jms_serializer')->deserialize($xml, 'UserBundle\Entity\User', 'xml');
        dump($obj);die;
        dump($this->get('jms_serializer')->serialize($users[0], 'xml'));die;
        $this->get('jms_serializer')->serialize($users[0], 'json');
        return $this->render('UserBundle:Default:list.html.twig', array(
            'users' => $users
        ));
    }
}
