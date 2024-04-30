<?php

//Connexion à la base de donnée
include("db_connect.php");

$request_method = $_SERVER["REQUEST_METHOD"];

//Déterminer l'action de l'utilisateur
switch($request_method){

    //En cas de requête GET, récupérer les activités
    case "GET":
        //Si un ID est spécifié, récupérer l'activité correspondante
        if(isset($_GET["id"]) && $_GET["id"] !== ""){
            $id=intval($_GET["id"]);
            getActiv($id);
        //Sinon, récupérer toutes les activités
        }else{
            getActivs();
        }
        break;
    
    //En cas de requête POST, inscrire l'utilisateur à une activité
    case "POST":
        inscrireActivite();
        break;
}

//Fonction pour récupérer les activités
function getActivs(){
    global $conn;
    
    $query = "SELECT * FROM activites";
    $response = array();

    $conn->query("SET NAMES 'utf8'");
    $result = $conn->query($query);
    while($row = $result->fetch()){
        $response[] = $row;
    }
    $result->closeCursor();
    header('Content-Type: application/json');
    echo json_encode($response);
}

//Fonction pour récupérer une activité spécifique
function getActiv($id){

    global $conn;

    //Vérifier que l'id est un nombre
    if (!is_numeric($id)) {
        echo json_encode(array("message" => "invalid_id"));
        return;
    }

    //Vérifier que l'id est supérieur à 0
    if ($id === 0) {
        echo json_encode(array("message" => "not_found"));
        return;
    }

    $queryActivites = "SELECT * FROM activites WHERE activites.id = :id";

    $responseActivites = array();

    $conn->query("SET NAMES 'utf8'");
    $result = $conn->prepare($queryActivites);

    if ($id != 0) {
        $result->bindParam(':id', $id);
    }

    $result->execute();

    //Vérifier que l'activité existe
    if ($result->rowCount() == 0) {
        echo json_encode(array("message" => "not_found"));
        return;
    }

    while($row = $result->fetch()){
        $responseActivites[] = $row;
    }

    $result->closeCursor();
    header('Content-Type: application/json');

    //Renvoyer l'activité
    echo json_encode($responseActivites);
}

//Fonction pour inscrire l'utilisateur à une activité
function inscrireActivite(){
    global $conn;

    //Récupérer les données de l'utilisateur
    $nomU = $_POST["nom"];
    $prenomU = $_POST["prenom"];
    $mailU = $_POST["mail"];
    $idActivite = $_POST["idActivite"];

    $userCheckQuery = "SELECT * FROM utilisateurs WHERE email = '$mailU'";
    $userCheckResult = $conn->query($userCheckQuery);

    //Vérifier si l'utilisateur existe, sinon le créer
    if ($userCheckResult->rowCount() == 0) {
        $insertUserQuery = "INSERT INTO utilisateurs (email, nom, prenom) VALUES ('$mailU', '$nomU', '$prenomU')";
        $conn->query($insertUserQuery);
    }

    $activityCheckQuery = "SELECT * FROM est_inscrit WHERE id_activite = '$idActivite' AND email = '$mailU'";
    $activityCheckResult = $conn->query($activityCheckQuery);

    //Vérifier si l'utilisateur est déjà inscrit à l'activité
    if ($activityCheckResult->rowCount() > 0) {
        $response = array(
            "status" => 0,
            "status_message" => "user_already_inscribed"
        );
    //Sinon, l'inscrire
    } else {
        $insertActivityQuery = "INSERT INTO est_inscrit (id_activite, email) VALUES ('$idActivite', '$mailU')";
        $conn->query($insertActivityQuery);

        $response = array(
            "status" => 1,
            "status_message" => "user_successfully_inscribed"
        );
    }

    header('Content-Type: application/json');
    
    echo json_encode($response);
}

?>