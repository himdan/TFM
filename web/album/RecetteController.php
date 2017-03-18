<?php

namespace Projet\ProjetBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecetteController extends Controller
{

    public function recetteAction()
    {

        return $this->render('ProjetBundle:recette:recette.html.twig');
    }

    public function detailsRecetteAction($recette)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository('AdministrationBundle:Recette')->find($recette);
        return $this->render('ProjetBundle:recette:details.html.twig',array('recette'=>$recette));
    }


    public function recetteJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $recettes = $em->getRepository('AdministrationBundle:Recette')->findAll();
        $ar = array();





        foreach($recettes as $ac){

            $th = array();
            $theme = $em->getRepository('AdministrationBundle:Theme')->findBy(array('id'=>$ac->getTheme()->toArray()));
            foreach ($theme as $t){
                array_push($th,$t->getId());
            }

            $ing = array();
            $ingredient = $em->getRepository('AdministrationBundle:Ingredient')->findBy(array('id'=>$ac->getIngredient()->toArray()));
            foreach ($ingredient as $i){
                array_push($ing,$i->getId());
            }

            $cui = array();
            $couisson = $em->getRepository('AdministrationBundle:TypeCuisson')->findBy(array('id'=>$ac->getTypecuisson()->toArray()));
            foreach ($couisson as $c){
                array_push($cui,$c->getId());
            }

            $sai = array();
            $saison = $em->getRepository('AdministrationBundle:Saison')->findBy(array('id'=>$ac->getSaison()->toArray()));
            foreach ($saison as $s){
                array_push($sai,$s->getId());
            }

            $request = $this->getRequest();
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getImage()->getId().'.'.$ac->getImage()->getUrl();

            array_push($ar,array(

                "id" => $ac->getId(),
                'titre'=>$ac->getNomRecette(),
                'image'=>$img,
                'cuisson'=>$ac->getCuissonRecette(),
                'preparation'=>$ac->getPreparationRecette(),
                'prix'=>$ac->getPrix()->getId(),
                'nationalite'=>$ac->getNationalite()->getId(),
                'difficulte'=>$ac->getDifficulte()->getId(),
                'menu'=>$ac->getMenu()->getId(),
                'themes'=>$th,
                'ingredients'=>$ing,
                'cuissonType'=>$cui,
                'saison'=>$sai

                )
            );

        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }

    // par prix

    public function prixJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $prixs = $em->getRepository('AdministrationBundle:Prix')->findAll();
        $ar = array();
        foreach($prixs as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'prix'=>$ac->getNomPrix()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }




    // par nationalite

    public function nationaliteJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $nationalites= $em->getRepository('AdministrationBundle:Nationalite')->findAll();
        $ar = array();
        foreach($nationalites as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'nationalite'=>$ac->getNomNationalite()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }



    // par difficulte

    public function difficulteJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $difficultes = $em->getRepository('AdministrationBundle:Difficulte')->findAll();
        $ar = array();
        foreach($difficultes as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'difficulte'=>$ac->getNomDifficulte()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }




    // par menu

    public function menuJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $menus = $em->getRepository('AdministrationBundle:Menu')->findAll();
        $ar = array();
        foreach($menus as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'menu'=>$ac->getNomMenu()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }


    // par theme

    public function themeJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $themes = $em->getRepository('AdministrationBundle:Theme')->findAll();
        $ar = array();
        foreach($themes as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'theme'=>$ac->getNomTheme()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }



    // subcategorie

    public function subcategorieJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $subcategories = $em->getRepository('AdministrationBundle:SubCategorie')->findAll();
        $ar = array();
        foreach($subcategories as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'subcategorie'=>$ac->getNomSubCategorie(),
                'menu'=>$ac->getMenu()->getId()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }

    // par ingredient

    public function ingredientJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $ingredients = $em->getRepository('AdministrationBundle:Ingredient')->findAll();
        $ar = array();
        foreach($ingredients as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'ingredient'=>$ac->getNomIngredient()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }

    // par couisson

    public function couissonJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $couissons = $em->getRepository('AdministrationBundle:TypeCuisson')->findAll();
        $ar = array();
        foreach($couissons as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'couisson'=>$ac->getNomTypeCuisson()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }

    // par saison

    public function saisonJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $couissons = $em->getRepository('AdministrationBundle:Saison')->findAll();
        $ar = array();
        foreach($couissons as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'saison'=>$ac->getNomSaison()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }
}
