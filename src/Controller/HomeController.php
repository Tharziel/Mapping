<?php

namespace App\Controller;

use App\Form\MapType;
use App\Service\Curl;
use App\Service\CurlS;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, Curl $curl, CurlS $curls): Response
    {
        $form = $this->createForm(MapType::class);
        $form->handleRequest($request);
        $lat = 48.85;
        $lon = 2.35;
        $message = 'Saisissez une ville et un code postal :';
        if($form->isSubmitted() && $form->isValid()){
            $city = $form->get('ville')->getData();
            $postal = $form->get('codepostal')->getData();
            
            $reponse = $curls->curl($city, $postal); //Je stocke dans $reponse
 
            if(empty($reponse) ){
                $lat = 48.85;
                $lon = 2.35;
                $message = "Veuillez saisir un nom de ville et un code postal corrects !";
            } else {
            $lat = $reponse[0]['lat'];
            $lon = $reponse[0]['lon'];
            }
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'lat' =>$lat,
            'lon' => $lon,
            'mess' => $message,
            'form' => $form->createView()
        ]);
    }
}
