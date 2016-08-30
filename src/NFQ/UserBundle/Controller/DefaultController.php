<?php

namespace NFQ\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NFQUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
