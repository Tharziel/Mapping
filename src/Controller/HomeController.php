<?php

namespace App\Controller;


use App\Form\MapType;
use App\Service\Curl;
use App\Form\MailType;
use App\Service\CurlS;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, Curl $curl, CurlS $curls, MailerInterface $mailer): Response
    {
        

        $form = $this->createForm(MapType::class);
        $form->handleRequest($request);

        $form2 = $this->createForm(MailType::class);
        $form2->handleRequest($request);
        if($form2->isSubmitted() && $form2->isValid()){
            $ville = htmlspecialchars($form2->get('ville')->getData()); //$_POST['ville'] qui récup dans post ville=ville_de_l_utilisateur
            $lat_m = $form2->get('latitude')->getData();
            $lon_m = $form2->get('longitude')->getData();
            $note= $form2->get('note')->getData();
            $from = htmlspecialchars($form2->get('mail')->getData());
            $email = (new TemplatedEmail())
            ->from($from)
            ->to('antoinerobert@mail.com')
            ->subject('Votre map')
            ->htmlTemplate('email/email.html.twig')
            ->context([
                'note' => $note,
                'latitude' => $lat_m,
                'longitude' => $lon_m,
                'ville' => ucfirst(strtolower($ville)),
            ]);

            $mailer->send($email);

            return $this->redirectToRoute('home');
        }
        $city = 'Paris';
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
            'ville' => $city,
            'lat' =>$lat,
            'lon' => $lon,
            'mess' => $message,
            'form2' => $form2->createView(),
            'form' => $form->createView()
        ]);
    }
}
