<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription aux Événements</title>
    <link rel="icon" href="views\downloads\Logo_Colore.png" type="image/png">
    <link rel="stylesheet" href="views/bootstrap/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">
        <img src="views/downloads/Logo_Colore.png" alt="Logo GSB Medical" style="width: 100px; height: auto; margin-right: 20px;">
        Inscription
    </h1>

    <!-- Afficher le nom de l'activité à laquelle l'utilisateur tente de s'inscrire -->
    <h3><?= $activite[0]->nom; ?></h3>

    <form method="post">
        <input type="hidden" name="idActivite" value=<?= $activite[0]->id; ?>>
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="mail" placeholder="Entrez votre adresse email" required>
        </div>
        <button type="submit" name="action" value="inscription" class="btn btn-primary">S'inscrire</button>
        <div class="mt-4">
            <a href="activites" class="btn btn-primary">Retour aux activités</a>
        </div>
    </form>
</div>

</body>
</html>
