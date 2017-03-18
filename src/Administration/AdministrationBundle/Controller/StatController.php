<?php

namespace Administration\AdministrationBundle\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Client\ClientBundle\Entity\Client;

/**
 * Stat controller.
 *
 */
class StatController extends Controller
{

    public function navigateurAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Statistiques des navigateurs les plus utilisés');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                                     'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrClient, p.navigateurClient as navigateur from ClientBundle:Client p group by p.navigateurClient');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){
            $a = array($value['navigateur'], intval($value['nbrClient']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Utilisateur', 'data' => $data)));

        return $this->render('@Administration/Stat/navigateur.html.twig', array(
            'chart' => $ob
        ));
    }

    public function systemeAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Statistiques des Systemes d\'exploitation les plus utilisés');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrClient, p.osClient as os from ClientBundle:Client p group by p.osClient');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){
            $a = array($value['os'], intval($value['nbrClient']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Utilisateur', 'data' => $data)));

        return $this->render('@Administration/Stat/systeme.html.twig', array(
            'chart' => $ob
        ));
    }

    public function paysAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Statistiques des Pays les plus inscrits');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrClient, p.paysClient as pays from ClientBundle:Client p group by p.paysClient');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){
            $a = array($value['pays'], intval($value['nbrClient']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Utilisateur', 'data' => $data)));

        return $this->render('@Administration/Stat/pays.html.twig', array(
            'chart' => $ob
        ));
    }

    public function villeAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Statistiques des Villes les plus inscrits');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrClient, p.villeClient as ville from ClientBundle:Client p group by p.villeClient');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){
            $a = array($value['ville'], intval($value['nbrClient']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Utilisateur', 'data' => $data)));

        return $this->render('@Administration/Stat/ville.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionTotalAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des articles ajouté Par Auteur (total)');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrArticle, f.username as nomClient from AdministrationBundle:Article p , ClientBundle:Client f where p.auteur = f.id group by f.username');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){
            $a = array($value['nomClient'], intval($value['nbrArticle']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Article', 'data' => $data)));

        return $this->render('@Administration/Stat/redaction.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionMonthAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des articles ajouté Par Mois');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrArticle, MONTH(p.dateArticle) mois from AdministrationBundle:Article p group by mois');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){

            if($value['mois']==1) $value['mois']='Janvier';
            if($value['mois']==2) $value['mois']='Février';
            if($value['mois']==3) $value['mois']='Mars';
            if($value['mois']==4) $value['mois']='Avril';
            if($value['mois']==5) $value['mois']='Mai';
            if($value['mois']==6) $value['mois']='Juin';
            if($value['mois']==7) $value['mois']='Juillet';
            if($value['mois']==8) $value['mois']='Aout';
            if($value['mois']==9) $value['mois']='Septembre';
            if($value['mois']==10) $value['mois']='Octobre';
            if($value['mois']==11) $value['mois']='Novembre';
            if($value['mois']==12) $value['mois']='Décembre';

            $a = array($value['mois'], intval($value['nbrArticle']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Article', 'data' => $data)));

        return $this->render('@Administration/Stat/redactionMonth.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionDayAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des articles ajouté Par Jour');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrArticle, DAY(p.dateArticle) jour from AdministrationBundle:Article p group by jour');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){



            $a = array($value['jour'], intval($value['nbrArticle']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Article', 'data' => $data)));

        return $this->render('@Administration/Stat/redactionDay.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionRecetteTotalAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des Recettes ajouté Par Auteur (total)');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrRecette, f.username as nomClient from AdministrationBundle:Recette p , ClientBundle:Client f where p.auteur = f.id group by f.username');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){
            $a = array($value['nomClient'], intval($value['nbrRecette']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Recette', 'data' => $data)));

        return $this->render('@Administration/Stat/redactionRecette.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionRecetteMonthAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des Recettes ajouté Par Mois');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrRecette, MONTH(p.dateRecette) mois from AdministrationBundle:Recette p group by mois');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){

            if($value['mois']==1) $value['mois']='Janvier';
            if($value['mois']==2) $value['mois']='Février';
            if($value['mois']==3) $value['mois']='Mars';
            if($value['mois']==4) $value['mois']='Avril';
            if($value['mois']==5) $value['mois']='Mai';
            if($value['mois']==6) $value['mois']='Juin';
            if($value['mois']==7) $value['mois']='Juillet';
            if($value['mois']==8) $value['mois']='Aout';
            if($value['mois']==9) $value['mois']='Septembre';
            if($value['mois']==10) $value['mois']='Octobre';
            if($value['mois']==11) $value['mois']='Novembre';
            if($value['mois']==12) $value['mois']='Décembre';

            $a = array($value['mois'], intval($value['nbrRecette']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Recette', 'data' => $data)));

        return $this->render('@Administration/Stat/redactionRecetteMonth.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionRecetteDayAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des Recette ajouté Par Jour');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrRecette, DAY(p.dateRecette) jour from AdministrationBundle:Recette p group by jour');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){



            $a = array($value['jour'], intval($value['nbrRecette']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Recette', 'data' => $data)));

        return $this->render('@Administration/Stat/redactionRecetteDay.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionRecetteHourAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des Recette ajouté Par Heure');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrRecette, HOUR(p.dateRecette) heure from AdministrationBundle:Recette p group by heure');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){



            $a = array($value['heure'], intval($value['nbrRecette']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Recette', 'data' => $data)));

        return $this->render('@Administration/Stat/redactionRecetteHour.html.twig', array(
            'chart' => $ob
        ));
    }

    public function redactionMembreAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentage + quantité des recettes activé Par Chaque membre');
        $ob->tooltip->pie(array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>',
        ));
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true,
                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select count(p.id) as nbrRecette, f.username as nomClient from AdministrationBundle:Recette p , ClientBundle:Client f where (p.auteurUpdate = f.id) and (p.activeRecette = 1) group by f.username');
        $result = $query->getResult();
        $data = array();

        foreach ($result as $value){



            $a = array($value['nomClient'], intval($value['nbrRecette']));
            array_push($data, $a);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Recette', 'data' => $data)));

        return $this->render('@Administration/Stat/redactionMembre.html.twig', array(
            'chart' => $ob
        ));
    }
}