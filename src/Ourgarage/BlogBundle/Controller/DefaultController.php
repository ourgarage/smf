<?php

namespace Ourgarage\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function indexAction()
    {
        $head = '<h1>Header</h1>';
        $text = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
            the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
            it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic 
            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
            containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
            versions of Lorem Ipsum.</p>';

        return $this->render('OurgarageBlogBundle:Default:index.html.twig', compact('head', 'text'));
    }

    /**
     * @Route("/page", name="page")
     */
    public function pageAction()
    {
        $text = 'This test text';

        return $this->render('OurgarageBlogBundle:Default:page.html.twig', compact('text'));
    }
}
