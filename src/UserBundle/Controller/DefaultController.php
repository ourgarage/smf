<?php

namespace UserBundle\Controller;

use CoreBundle\Controller\MainController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends MainController
{
    /**
     * @Route("/", name="users")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/create", name="create-user")
     */
    public function createUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
    
            return $this->redirectToRoute('users');
        }
        
        return $this->render('UserBundle:Users:create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
