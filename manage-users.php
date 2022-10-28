<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="manage.css">

    <title>Document</title>
</head>
<body>
    <header>

        <div class="topnav">
            <a href="main_page.php"><img src="poste.jpg" alt=""></a>
            <a href="users.php" class="text">Utilisateurs</a>
            <a href="manage-users.php" class="text">Gestion des utilisateurs</a>
            <a href="users_log.php" class="text">Entrée des utilisateurs</a>
            <a class="text">Se deconnecter</a>
        </div>
        <div class="up_info1 alert-danger"></div>
        <div class="up_info2 alert-success"></div>
    </header>


        <div class="ajouter">
            <form action="#">

                <input type="text" name="email" id="username1" placeholder="Entrer le nom de l'employé"><br>
                <input type="text" name="serial" id="serail1" placeholder="Numéro de série"><br>

                <legend>Choisissez le genre</legend>

                <input type="radio" id="femme" name="drone" value="femme" checked>
                <label for="huey" class="female">Femme</label>
                <input type="radio" id="homme" name="drone" value="homme">
                <label for="homme" class="male">Homme</label><br>
                <input type="submit" value="Ajouter" name="boutton-valider">
        </div>

        <div class="modifier">
            <form action="#">

                <input type="text" name="email" id="username1" placeholder="Entrer le nom de l'employé"><br>
                <input type="text" name="serial" id="serail1" placeholder="Numéro de série"><br>

                <legend>Choisissez le genre</legend>

                <input type="radio" id="femme1" name="drone1" value="femme1" checked>
                <label for="huey" class="female">Femme</label>
                <input type="radio" id="homme1" name="drone1" value="homme1">
                <label for="homme" class="male">Homme</label><br>
                <input type="submit" value="Modifier" name="boutton-valider">
        </div>



</body>
</html>
