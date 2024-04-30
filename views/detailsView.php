<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="views\downloads\Logo_Colore.png" type="image/png">
    <title>Détails du Médicament</title>
    <link href="views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Détails du Médicament</h3>
            </div>
            <div class="card-body">
                <h5>Nom du médicament</h5>
                <!-- Afficher les données du médicament -->
                <p class="lead"><?= $medicament->medicament[0]->nom; ?></p>

                <h5>Date de Création</h5>
                <p class="lead"><?= $medicament->medicament[0]->date_creation; ?></p>

                <h5>Laboratoire Créateur</h5>
                <p class="lead"><?= $medicament->medicament[0]->laboratoire_createur; ?></p>

                <h5>Dose journalière maximale</h5>
                <p class="lead"><?= $medicament->medicament[0]->dose_max_journaliere; ?></p>

                <h5>Effets Thérapeutiques</h5>
                <ul>
                    <!-- Boucle qui parcourt tous les effets thérapeutiques -->
                    <?php foreach($medicament->effets_therapeutiques as $effet_therapeutique): ?>
                        <li class="lead"><?= $effet_therapeutique->effets_therapeutiques; ?></li>
                    <?php endforeach; ?>
                </ul>

                <h5>Effets Secondaires</h5>
                <ul>
                    <!-- Boucle qui parcourt tous les effets secondaires -->
                    <?php foreach($medicament->effets_secondaires as $effet_secondaire): ?>
                        <li class="lead"><?= $effet_secondaire->effets_secondaires; ?></li>
                    <?php endforeach; ?>
                </ul>

                <h5>Médicaments Réactifs</h5>
                <ul>
                    <!-- Boucle qui parcourt tous les médicaments réactifs -->
                    <?php foreach($medicament->reactions as $reaction): ?>
                        <li class="lead"><?= $reaction->nom; ?></li>
                        <ul>
                            <li class="lead"><?= $reaction->reaction; ?></li>
                        </ul>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>

        <div class="mt-4">
            <a href="medicaments" class="btn btn-primary">Retour à la liste</a>
        </div>
    </div>
</body>
</html>