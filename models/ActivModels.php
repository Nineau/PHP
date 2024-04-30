<?php

//Fonction pour récupérer les activités
function getActivs(){
    
    //Endpoint de l'API
    $url = "http://localhost/projet-3-php/api/activites";

    //Options de la requête
    $option = array(
        "http" => array(
            "method" => "GET",
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n"
        )
    );
    $context = stream_context_create($option);
    $result = file_get_contents($url, false, $context);

    //Retourner le résultat de la requête
    return json_decode($result);
}

//Fonction pour récupérer une activité spécifique
function getActiv($id){
    
    //Endpoint de l'API
    $url = "http://localhost/projet-3-php/api/activites?id=$id";

    //Options de la requête
    $option = array(
        "http" => array(
            "method" => "GET",
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n"
        )
    );
    $context = stream_context_create($option);
    $result = file_get_contents($url, false, $context);

    //Si l'activité n'existe pas, retourner null
    if(isset(json_decode($result)->message)){
        if (json_decode($result)->message == "invalid_id" || json_decode($result)->message == "not_found") {
            return null;
        }
    }

    //Retourner le résultat de la requête
    return json_decode($result);
}

//Fonction pour inscrire un utilisateur à une activité
function inscrireActivite($nomU, $prenomU, $mailU, $idActivite){
        
    //Endpoint de l'API
    $url = "http://localhost/projet-3-php/api/activites";

    $data = array(
        "nom" => $nomU,
        "prenom" => $prenomU,
        "mail" => $mailU,
        "idActivite" => $idActivite
    );

    //Passer les données du formulaire en POST
    $option = array(
        "http" => array(
            "method" => "POST",
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
            "content" => http_build_query($data)
        )
    );

    $context = stream_context_create($option);
    $result = file_get_contents($url, false, $context);

    //Retourner le résultat de la requête
    return $result;
}


?>