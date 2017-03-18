<?php

namespace Client\ClientBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class NotificationController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction()
    {
        return $this->render('ClientBundle:Notification:notification.html.twig');
    }

    public function getAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $notifications = $em->getRepository('ClientBundle:Notification')->getByUser($user);
        $notificationTab = array();
        foreach ($notifications as $notification){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$notification->getClient()->getImage()->getId().'.'.$notification->getClient()->getImage()->getUrl();
            array_push($notificationTab,
                array(
                    'texte' => $notification->getDescriptionNotification(),
                    'client' => $notification->getClient()->getNomClient() . ' ' . $notification->getClient()->getPrenomClient(),
                    'imageClient' => $img,
                    'publication' => substr($notification->getPublication()->getTextePublication(),0,20),
                    'lu' => $notification->getLuNotification(),
                    'date' => $notification->getDateNotification()->format('d/m/Y')
                )
            );
        }
        return new JsonResponse($notificationTab);
    }


}
