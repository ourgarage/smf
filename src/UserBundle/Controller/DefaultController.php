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
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="users")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="create-user")
     */
    public function createUserAction(Request $request)
    {
        $user = new User();
    
        return $this->handleUserForm($request, $user);
    }
    
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/all", name="all-users")
     */
    public function allUsersAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('UserBundle:Users:allusers.html.twig', compact('users'));
    }
    
    /**
     * @param Request $request
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/edit/{id}", name="edit-user")
     */
    public function editUserAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->handleUserForm($request, $user);
    }
    
    /**
     * @param Request $request
     * @param User $user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    private function handleUserForm(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
        
            $em = $this->getManager();
            $em->persist($user);
            $em->flush();
        
            return $this->redirectToRoute('users');
        }
    
        return $this->render('UserBundle:Users:user_manage.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
