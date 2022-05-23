<?php

namespace App\Service;

class Curl
{
    function curl($city, $postal){
        
        $url = "https://nominatim.openstreetmap.org/search?city=$city&postalcode=$postal&format=json"; //url à laquelle on fait la demande et qui renverra une réponse
        
        $request = curl_init(); //initialisation du cURL
        
        curl_setopt($request, CURLOPT_URL, $url); //On pointe vers l'URL
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true); //On demande qu'une réponse soit retournée
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false); // Permet de retirer la vérification SSL (si il y en a une)
        curl_setopt($request, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36');
        
        $reponse = curl_exec($request); // On stock la réponse retournée dans une variable
        
        if($reponse === false){ //Verifie l'erreur retournée
            echo 'Error : ' . curl_error($request);
        } 
        
        $status = curl_getinfo($request, CURLINFO_HTTP_CODE); // Code du status de la réponse (200 si ça marche)
        
        curl_close($request); // Fermeture du cURL (ne pas le faire provoque une fuite de données et une utilisation de la mémoire du serveur)
        
        $reponse = json_decode($reponse, true); // La réponse est en json on la décode
        
        return $reponse;
    }
}