<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UrlController extends Controller
{
    /**
     * @Route("/url", name="url")
     */
    public function indexAction()
    {
        $response_code = "";
        $url = "";
        $output = "";
        if(isset($_POST['url'])) {
            $url = $_POST['url'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
            $output = curl_exec($ch);
            $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

        }
        // replace this example code with whatever you need
        return $this->render('url/index.html.twig', [
            'response_code' => $response_code,
            'url' => $url,
            'output' => $output,

        ]);
    }
}