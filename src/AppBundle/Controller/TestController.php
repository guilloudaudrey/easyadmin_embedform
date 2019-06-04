<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController;

class TestController extends AdminController
{
    /**
    * @Route("/admin/test/{id}", name="test")
    * @Method("GET")
    */
    public function testAction($id)
    {
        return new Response($id);
    }


}