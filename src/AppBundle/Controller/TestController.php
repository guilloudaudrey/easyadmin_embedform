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
use Symfony\Component\PropertyAccess\PropertyAccess;

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


    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToReferrer()
    {
        $refererAction = $this->request->query->get('action');

        // from new|edit action, redirect to edit if possible
        if (in_array($refererAction, array('new', 'edit')) && $this->isActionAllowed('edit')) {
            return $this->redirectToRoute('easyadmin', array(
                'action' => 'edit',
                'entity' => $this->entity['name'],
                'menuIndex' => $this->request->query->get('menuIndex'),
                'submenuIndex' => $this->request->query->get('submenuIndex'),
                'id' => ('new' === $refererAction)
                    ? PropertyAccess::createPropertyAccessor()->getValue($this->request->attributes->get('easyadmin')['item'], $this->entity['primary_key_field_name'])
                    : $this->request->query->get('id'),
            ));
        }

        return parent::redirectToReferrer();
    }

    protected function updateUrlEntity($entity){
        parent::updateEntity($entity);
        $this->redirectToReferrer();

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