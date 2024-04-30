<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des activités - Projet 3 PHP</title>
    <link rel="icon" href="views\downloads\Logo_Colore.png" type="image/png">
    <link rel="stylesheet" href="views/bootstrap/css/bootstrap.min.css">
    <style>
        .card {
            flex: 0 0 calc(33.33% - 1rem);
            margin-right: 1rem;
            margin-bottom: 1rem;
        }
        .card-body {
            min-height: 200px;
        }
        @media (max-width: 992px) {
            .card {
                flex: 0 0 calc(50% - 1rem);
            }
        }
        @media (max-width: 576px) {
            .card {
                flex: 0 0 100%;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">

<!-- Récupérer le paramàtre GET "status" pour déterminer si l'utilisateur vient d'essayer de s'inscrire à une activité -->
<!-- Si le paramètre est "error", afficher un message d'erreur -->
<!-- Si le paramètre est "success", afficher un message de succès -->
<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] === 'error'): ?>
        <div class="text-center mt-3">
            <div class="alert alert-danger d-inline-block" role="alert">
                <strong>Erreur :</strong> Vous êtes déjà inscrits à cette activité
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['status'] === 'success'): ?>
        <div class="text-center mt-3">
            <div class="alert alert-success d-inline-block" role="alert">
                <strong>Succès :</strong> Vous vous êtes inscrits à cette activité
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<h1 class="text-center">
    <img src="views/downloads/Logo_Colore.png" alt="Logo GSB Medical" style="width: 100px; height: auto; margin-right: 20px;">
    Liste des activités
</h1>
<br> <br>

<div class="d-flex flex-wrap justify-content-between">
    <!-- Boucle qui parcourt toutes les activités récupérés dans le modèle et les affiche -->
    <?php foreach ($activites as $activite): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $activite->nom; ?></h5>
                <p class="card-text"><?= $activite->description; ?></p>
                <p class="card-text">Places restantes : <?= $activite->nombre_places; ?></p>
                <p class="card-text"><?php echo date('d/m/Y H:i', strtotime($activite->date_heure)); ?></p>
                <a href="inscription?activite=<?= $activite->id; ?>" class="btn btn-primary">Inscription</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="mt-4">
    <a href="home" class="btn btn-primary">Retour à l'Accueil</a>
</div>

</div>
</body>
</html>
