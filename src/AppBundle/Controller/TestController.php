<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\FormBuilder;
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


    public function createUrlEntityFormBuilder($entity, $view) {

        $formBuilder = parent::createEntityFormBuilder($entity, $view);
        $fields = $formBuilder->all();
        /**
         * @var  $fieldId string
         * @var  $field FormBuilder
         */
        foreach ($fields as $fieldId => $field) {
            if ($fieldId == 'perimeter') {
                $options = [
                    'class'    => 'AppBundle\Entity\Perimeters',
                    'group_by' => 'Perimeter'
                ];
                $options['query_builder'] = function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('p');

                    return $qb->select('p')
                        ->addSelect('pc')
                        ->leftJoin('p.children', 'pc')
                        ->addSelect('pcpc')
                        ->leftJoin('pc.children', 'pcpc');
                        ;


                };


                $formBuilder->add($fieldId, EntityType::class, $options);
            }
        }
        return $formBuilder;
    }


}