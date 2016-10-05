<?php

namespace ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ReservationBundle\Entity\Passage;
use ReservationBundle\Form\PassageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Passage controller.
 *
 * @Route("/passage")
 */
class PassageController extends Controller {

    /**
     * Lists all Passage entities.
     *
     * @Route("/", name="passage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ReservationBundle:Passage')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Passage entity.
     *
     * @Route("/", name="passage_create")
     * @Method("POST")
     * @Template("ReservationBundle:Passage:new.html.twig")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createAction(Request $request) {

        $entity = new Passage();



        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $quantity = $entity->getData($noOfPlaces);
         

            $em->flush();

            return $this->redirect($this->generateUrl('passage_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Passage entity.
     *
     * @param Passage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Passage $entity) {
        $form = $this->createForm(new PassageType(), $entity, array(
            'action' => $this->generateUrl('passage_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Passage entity.
     *
     * @Route("/new", name="passage_new")
     * @Method("GET")
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction() {
        $entity = new Passage();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Passage entity.
     *
     * @Route("/{id}", name="passage_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReservationBundle:Passage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Passage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Passage entity.
     *
     * @Route("/{id}/edit", name="passage_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReservationBundle:Passage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Passage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Passage entity.
     *
     * @param Passage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Passage $entity) {
        $form = $this->createForm(new PassageType(), $entity, array(
            'action' => $this->generateUrl('passage_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Passage entity.
     *
     * @Route("/{id}", name="passage_update")
     * @Method("PUT")
     * @Template("ReservationBundle:Passage:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReservationBundle:Passage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Passage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('passage_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Passage entity.
     *
     * @Route("/{id}", name="passage_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')") 
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ReservationBundle:Passage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Passage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('passage'));
    }

    /**
     * Creates a form to delete a Passage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('passage_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
