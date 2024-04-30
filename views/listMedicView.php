<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Médicaments</title>
    <link rel="icon" href="views\downloads\Logo_Colore.png" type="image/png">
    <link href="views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">
        <img src="views/downloads/Logo_Colore.png" alt="Logo GSB Medical" style="width: 100px; height: auto; margin-right: 20px;">
        Liste des Médicaments
    </h1>

    <!-- Création d'un tableau affichant les informations principales des médicaments -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Date de Création</th>
                <th scope="col">Laboratoire Créateur</th>
                <th scope="col">Détails</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle qui parcourt tous les médicaments récupérés dans le modèle et les ajoute au tableau -->
            <?php foreach($medicaments as $medicament): ?>
            <tr>
                <td><?= $medicament->nom ?></td>
                <td><?= $medicament->date_creation ?></td>
                <td><?= $medicament->laboratoire_createur ?></td>
                <td><a href="details?id=<?= $medicament->id ?>" class="btn btn-primary">Détails</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="mt-4">
        <a href="home" class="btn btn-primary">Retour à l'Accueil</a>
    </div>
</div>

</body>
</html>
