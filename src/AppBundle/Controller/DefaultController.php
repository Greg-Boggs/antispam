<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Message;

class MessageController extends FOSRestController
{
    /**
     * @Rest\Get("/")
     */
    public function indexAction(Request $request)
    {
        $view = $this->view(['hello' => 'world'], Response::HTTP_OK);
        return $view;
    }

    /**
     * @Rest\Get("/rest")
     */
    public function getAction()
    {
         return $this->getDoctrine()->getRepository('AppBundle:Message')->findAll();
    }

    /**
     * @Rest\Get("/rest/id/{id}")
     */
    public function idAction($id)
    {
          //  $id = $request->query->get('id');
         return $this->getDoctrine()->getRepository('AppBundle:Message')->find($id);
    }

    /**
     * @Rest\Post("/rest/send/")
     */
    public function postAction(Request $request)
    {
        $data = new Message;
        $name = $request->query->get('name');
        $role = $request->query->get('role');
        $data->setName($name);
        $data->setRole($role);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
         $re = 'Message Added Successfully';

            return $re;
    }

    /**
     * @Rest\Delete("/rest/delete/{id}")
     */
    public function deleteAction($id)
    {
        $data = new Message;
       // $id = $request->query->get('id');
        $sn = $this->getDoctrine()->getManager();
        $todo = $this->getDoctrine()->getRepository('AppBundle:Message')->find($id);
        $sn->remove($todo);
        $sn->flush();
        
            $re = 'Message Deleted Successfully';

            return $re;
    }

    /**
     * @Rest\Put("/rest/update")
     */
    public function updateAction(Request $request)
    {
        $data = new Message;
        $id = $request->query->get('id');
        $name = $request->query->get('name');
        $role = $request->query->get('role');

        $sn = $this->getDoctrine()->getManager();
        $todo = $this->getDoctrine()->getRepository('AppBundle:Message')->find($id);
        $todo->setName($name);
        $todo->setRole($role);
        $sn->flush();
         $re = 'Message Updated Successfully';
         return $re;
    }


}
