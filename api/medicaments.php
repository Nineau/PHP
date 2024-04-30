<?php

//Connexion à la base de données
include("db_connect.php");

$request_method = $_SERVER["REQUEST_METHOD"];

//Déterminer l'action de l'utilisateur
switch($request_method){

    //En cas de requête GET, récupérer les médicaments
    case "GET":
        //Si un ID est spécifié, récupérer le médicament correspondant
        if(isset($_GET["id"]) && $_GET["id"] !== ""){
            $id=intval($_GET["id"]);
            getMedic($id);
        //Sinon, récupérer tous les médicaments
        }else{
            getMedics();
        }
        break;
}

//Fonction pour récupérer les médicaments
function getMedics(){
    global $conn;
    
    $query = "SELECT * FROM medicaments";
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

//Fonction pour récupérer un médicament spécifique
function getMedic($id){
    global $conn;

    //Vérifier que l'id est un nombre
    if (!is_numeric($id)) {
        echo json_encode(array("message" => "invalid_id"));
        return;
    }

    //Vérifier que l'id est supérieur à 0
    if($id === 0){
        echo json_encode(array("message" => "not_found"));
        return;
    }

    $queryMedic = "SELECT * FROM medicaments WHERE medicaments.id = :id";

    $responseMedic = array();

    $conn->query("SET NAMES 'utf8'");
    $result = $conn->prepare($queryMedic);
    
    if ($id != 0) {
        $result->bindParam(':id', $id);
    }

    $result->execute();

    //Vérifier que le médicament existe
    if ($result->rowCount() == 0) {
        echo json_encode(array("message" => "not_found"));
        return;
    }

    while($row = $result->fetch()){
        $responseMedic[] = $row;
    }

    $result->closeCursor();

    //Récupérer les effets thérapeutiques du médicament
    $queryEffetsTherapeutiques = "SELECT liste_effets_therapeutiques.effet AS effets_therapeutiques FROM medicaments
        JOIN effet_therapeutique ON effet_therapeutique.id_medicament = medicaments.id
        JOIN liste_effets_therapeutiques ON liste_effets_therapeutiques.id = effet_therapeutique.id_effet WHERE medicaments.id = :id";

    $responseEffetsTherapeutiques = array();

    $result = $conn->prepare($queryEffetsTherapeutiques);
    
    if ($id != 0) {
        $result->bindParam(':id', $id);
    }

    $result->execute();

    while($row = $result->fetch()){
        $responseEffetsTherapeutiques[] = $row;
    }

    $result->closeCursor();

    //Récupérer les effets secondaires du médicament
    $queryEffetsSecondaires = "SELECT liste_effets_secondaires.effet AS effets_secondaires FROM medicaments
        JOIN effet_secondaire ON effet_secondaire.id_medicament = medicaments.id
        JOIN liste_effets_secondaires ON liste_effets_secondaires.id = effet_secondaire.id_effet WHERE medicaments.id = :id";

    $responseEffetsSecondaires = array();

    $result = $conn->prepare($queryEffetsSecondaires);
    
    if ($id != 0) {
        $result->bindParam(':id', $id);
    }

    $result->execute();

    while($row = $result->fetch()){
        $responseEffetsSecondaires[] = $row;
    }

    $result->closeCursor();

    //Récupérer les réactions du médicament
    //On récupère toutes les lignes ou est contenu l'id du médicament que ce soit dans id_medicament_1 ou id_medicament_2
    $queryReactions = "SELECT DISTINCT Medicaments.nom, reagit_avec.reaction
                       FROM Medicaments
                       JOIN reagit_avec ON ((Medicaments.id = reagit_avec.id_medicament_1 OR Medicaments.id = reagit_avec.id_medicament_2) 
                                            AND Medicaments.id != :id_medicament)
                       WHERE reagit_avec.id_medicament_1 = :id_medicament OR reagit_avec.id_medicament_2 = :id_medicament";

    $responseReactions = array();

    $resultReactions = $conn->prepare($queryReactions);
    $resultReactions->bindParam(':id_medicament', $id);
    
    if ($id != 0) {
        $resultReactions->bindParam(':id', $id);
    }

    $resultReactions->execute();

    while($row = $resultReactions->fetch()){
        $responseReactions[] = $row;
    }

    $resultReactions->closeCursor();

    //On lie toutes les données en un seul résultat JSON
    $responseData = array(
        'message' => 'success',
        'medicament' => $responseMedic,
        'effets_therapeutiques' => $responseEffetsTherapeutiques,
        'effets_secondaires' => $responseEffetsSecondaires,
        'reactions' => $responseReactions
    );

    header('Content-Type: application/json');

    echo json_encode($responseData);
}

?>