<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Topic;
use Administration\AdministrationBundle\Form\TopicType;

/**
 * Topic controller.
 *
 */
class TopicController extends Controller
{
    /**
     * Lists all Topic entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('AdministrationBundle:Topic')->findAll();

        return $this->render('topic/index.html.twig', array(
            'topics' => $topics,
        ));
    }

    /**
     * Creates a new Topic entity.
     *
     */
    public function newAction(Request $request)
    {
        $topic = new Topic();
        $form = $this->createForm('Administration\AdministrationBundle\Form\TopicType', $topic);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('AdministrationBundle:Topic')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $topic->setDateTopic(new \DateTime());
            $em->persist($topic);
            $em->flush();

            return $this->redirectToRoute('topic_index');
        }

        return $this->render('topic/new.html.twig', array(
            'topic' => $topic,
            'topics'=>$topics,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Topic entity.
     *
     */
    public function showAction(Topic $topic)
    {
        $deleteForm = $this->createDeleteForm($topic);

        return $this->render('topic/show.html.twig', array(
            'topic' => $topic,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Topic entity.
     *
     */
    public function editAction(Request $request, Topic $topic)
    {
        $deleteForm = $this->createDeleteForm($topic);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\TopicType', $topic);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('AdministrationBundle:Topic')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();

            return $this->redirectToRoute('topic_index');
        }

        return $this->render('topic/edit.html.twig', array(
            'topic' => $topic,
            'topics'=>$topics,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Topic entity.
     *
     */
    public function deleteAction(Request $request, Topic $topic)
    {
        $form = $this->createDeleteForm($topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($topic);
            $em->flush();
        }

        return $this->redirectToRoute('topic_index');
    }

    /**
     * Creates a form to delete a Topic entity.
     *
     * @param Topic $topic The Topic entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Topic $topic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('topic_delete', array('id' => $topic->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
