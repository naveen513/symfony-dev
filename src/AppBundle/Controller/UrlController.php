<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Url;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UrlController extends Controller
{
    /**
     * @Route("/url", name="url_index")
     */
    public function indexAction()
    {
        $urls = $this->getDoctrine()
            ->getRepository('AppBundle:Url')
            ->findAll();

        return $this->render('url/index.html.twig', [
            'urls' => $urls,

        ]);
    }

    /**
     * @Route("/url/create", name="url_create")
     */
    public function createAction(Request $request) {
        $url = new Url();

        $form = $this->createFormBuilder($url)
            -> add('title',TextType::class,array('attr'=> array('class'=>'form-control','style'=>'margin-bottom:15px')))
            -> add('domain',TextType::class,array('attr'=> array('class'=>'form-control','style'=>'margin-bottom:15px')))
            -> add('url',TextType::class,array('attr'=> array('class'=>'form-control','style'=>'margin-bottom:15px')))
            -> add('status',ChoiceType::class,array('choices'=>array('Disabled'=>'Disabled','Enabled'=>'Enabled'),'attr'=> array('class'=>'form-control','style'=>'margin-bottom:15px')))
            -> add('body',TextareaType::class,array('attr'=> array('class'=>'form-control','style'=>'margin-bottom:15px')))
            -> add('save',SubmitType::class,array('attr'=> array('class'=>'btn btn-primary')))
            -> getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){

            $url->setTitle($form['title']->getData());
            $url->setDomain($form['domain']->getData());
            $url->setUrl($form['url']->getData());
            $url->setStatus($form['status']->getData());
            $url->setBody($form['body']->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($url);
            $em->flush();

            $this->addFlash('success','Url Added');

            return $this->redirectToRoute('url_index');
        }
        return $this->render('url/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}