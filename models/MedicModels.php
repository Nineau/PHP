<?php

//Fonction pour récupérer les médicaments
function getMedics(){
    
    //Endpoint de l'API
    $url = "http://localhost/projet-3-php/api/medicaments";

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

//Fonction pour récupérer un médicament spécifique
function getMedic($id){
    
    //Endpoint de l'API
    $url = "http://localhost/projet-3-php/api/medicaments?id=$id";

    //Options de la requête
    $option = array(
        "http" => array(
            "method" => "GET",
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n"
        )
    );
    $context = stream_context_create($option);
    $result = file_get_contents($url, false, $context);

    //Si le médicament n'existe pas, retourner null
    if (json_decode($result)->message == "invalid_id" || json_decode($result)->message == "not_found") {
        return null;
    }

    //Retourner le résultat de la requête
    return json_decode($result);
}

?>