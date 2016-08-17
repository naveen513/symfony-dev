<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Url;
use AppBundle\Form\UrlFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UrlController extends Controller
{
    public function indexAction() {
        $urls = $this->getDoctrine()
            ->getRepository('AppBundle:Url')
            ->findAll();

        return $this->render('url/index.html.twig', [
            'urls' => $urls,
        ]);
    }

    public function createAction(Request $request) {
        $url = new Url();

        $form = $this->createForm(UrlFormType::class, $url);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($url);
            $em->flush();

            $this->addFlash('success', 'Url Added');

            return $this->redirectToRoute('url_index');
        }

        return $this->render('url/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function testAction(Request $request) {
        $url = $_REQUEST['url'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        $output = curl_exec($ch);
        $data['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return new JsonResponse($data);
    }
}