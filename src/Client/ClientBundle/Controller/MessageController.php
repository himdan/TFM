<?php

namespace Client\ClientBundle\Controller;

use Client\ClientBundle\Entity\Discussion;
use Client\ClientBundle\Entity\MessageRelation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class MessageController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction()
    {
        return $this->render('ClientBundle:Message:message.html.twig');
    }

    public function messageRelationAction(Request $request){
        $em =$this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $messages = $em->getRepository('ClientBundle:MessageRelation')->findByTousMessage($user);
        $messagesTab = array();

        foreach ($messages as $message){

            if($message->getReceiver() == $user){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$message->getSender()->getImage()->getId().'.'.$message->getSender()->getImage()->getUrl();
                array_push($messagesTab,
                    array(
                        'id' => $message->getId(),
                        'receiver' => $message->getSender()->getNomClient() .' '. $message->getSender()->getPrenomClient(),
                        'idreceiver' => $message->getSender()->getId(),
                        'lastMessage' => substr($message->getLastMessageRelation(),0,20),
                        'imageReceiver' => $img,
                        'dateLastMessage' => $message->getDateMessageRelation()->format('Y/m/d'),
                        'lu' => $message->getLuMessageRelation()
                    )
                );
            }else{
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$message->getReceiver()->getImage()->getId().'.'.$message->getReceiver()->getImage()->getUrl();
                array_push($messagesTab,
                    array(
                        'id' => $message->getId(),
                        'receiver' => $message->getReceiver()->getNomClient() .' '. $message->getReceiver()->getPrenomClient(),
                        'idreceiver' => $message->getReceiver()->getId(),
                        'lastMessage' => substr($message->getLastMessageRelation(),0,20),
                        'imageReceiver' => $img,
                        'dateLastMessage' => $message->getDateMessageRelation()->format('Y/m/d'),
                        'lu' => $message->getLuMessageRelation()
                    )
                );
            }

        }

        return new JsonResponse($messagesTab);
    }

    public function discussionAction($message,Request $request){
        $em =$this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $discussions = $em->getRepository('ClientBundle:Discussion')->findBy(array('message'=>$message));
        $discussionTab = array();

        foreach ($discussions as $discussion){


                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$discussion->getSender()->getImage()->getId().'.'.$discussion->getSender()->getImage()->getUrl();
                array_push($discussionTab,
                    array(
                        'messageId' => $discussion->getMessage()->getId(),
                        'discuId' => $discussion->getId(),
                        'sender' => $discussion->getSender()->getUsername(),
                        'message' => $discussion->getTexteDiscussion(),
                        'image' => $img,
                        'date' => $discussion->getDateDiscussion()->format('Y/m/d')
                    )
                );


        }

        return new JsonResponse($discussionTab);
    }

    public function addMessageAction(Request $request){
        $em =$this->getDoctrine()->getManager();
        $sendMessage = new Discussion();
        $message = $request->get('textareaMessage');
        $idMessage = $request->get('idmessage');
        $idreceiver = $request->get('idreceiver');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $receiverId = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$idreceiver));
        $messageId = $em->getRepository('ClientBundle:MessageRelation')->find($idMessage);

        $sendMessage->setReceiver($receiverId);
        $sendMessage->setMessage($messageId);
        $sendMessage->setSender($user);
        $sendMessage->setTexteDiscussion($message);
        $sendMessage->setDateDiscussion(new \DateTime);
        $messageId->setDateMessageRelation(new \DateTime);
        $messageId->setLastMessageRelation($message);

        $em->persist($sendMessage);
        $em->flush();

        return new JsonResponse('ok');




    }

    public function setLuMessageAction($message,Request $request){
        $em =$this->getDoctrine()->getManager();
        $idMessage = $em->getRepository('ClientBundle:MessageRelation')->find($message);
        $idMessage->setLuMessageRelation('');
        $em->persist($idMessage);
        $em->flush();
        return new JsonResponse('active');
    }




}
