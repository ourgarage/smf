<?php

namespace AuthBundle\Controller;

use AuthBundle\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $form = $this->createForm(LoginType::class);

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AuthBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function myPageAction()
    {
        return $this->render('AuthBundle:Default:admin.html.twig');
    }
}
