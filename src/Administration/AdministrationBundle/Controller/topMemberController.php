<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Ingredient;
use Administration\AdministrationBundle\Form\IngredientType;

/**
 * Ingredient controller.
 *
 */
class topMemberController extends Controller
{
    /**
     * Lists all Ingredient entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('AdministrationBundle:TopMember:photographe.html.twig');
    }

    public function ecrivainAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('AdministrationBundle:TopMember:ecrivain.html.twig');
    }

    public function gourmandAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('AdministrationBundle:TopMember:gourmand.html.twig');
    }
}
