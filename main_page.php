
<?php 
//On demare la session sur sur cette page 
session_start() ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="main-page.css">
</head>
<body>
    <header>
        <div class="header">
            <h1><img src="poste.jpg" alt=""></h1>
        </div>

        <div class="topnav">
            <a href="users.php">Liste des employés</a>
            <a href="manage-users.php">Gestion des employés</a>
            <a href="users_log.php">Entrées/Sorties</a>
            <a>Se deconnecter</a>
        </div>
        <div class="up_info1 alert-danger"></div>
        <div class="up_info2 alert-success"></div>
    </header>
</body>
</html>