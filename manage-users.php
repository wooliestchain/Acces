
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
            <a href="users-log.php" class="text">Entrée des utilisateurs</a>
            <a class="text">Se deconnecter</a>
        </div>
        <div class="up_info1 alert-danger"></div>
        <div class="up_info2 alert-success"></div>
    </header>


        <div class="ajouter">
            <form action="ajout.php" method="post">

                <input type="text" name="name" id="username1" placeholder="Entrer le nom de l'employé"><br>
                <input type="text" name="serial" id="serail1" placeholder="Numéro de série"><br>
                <input type="text" name="card_id" id="serail1" placeholder="ID Carte"><br>
                <input type="text" name="card_id_select" id="serail1" placeholder="CarteID select"><br>

                <legend>Choisissez le genre</legend>

                <input type="radio" id="femme" name="drone" value="femme" checked>
                <label for="huey" class="female">Femme</label>
                <input type="radio" id="homme" name="drone" value="homme">
                <label for="homme" class="male">Homme</label><br>
                <input type="submit" value="Ajouter" name="boutton-valider-ajout">
        </div>





    <section>
        <h1 class="user_list">Liste des utilisateurs</h1>
        <div class="table_list">
            <table class="table">
                <thead class="table_primary">
                <tr>
                    <td class="info">NOM</td>
                    <td class="info">Numéro</td>
                    <td class="info">Genre</td>
                    <td class="info" hidden>UID</td>
                    <td  class="info" hidden>UID Select</td>
                    <td  class="info">Modifier</td>
                </tr>
                </thead>
                <tbody class="table_secondary">
                <?php
                //Connect to database
                $nom_serveur = "localhost";
                $utilisateur = "root";
                $mot_de_passe = "";
                $nom_base_données = "nodemculog";
                $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);

                $sql = "SELECT * FROM users ORDER BY id DESC";
                $result = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo '<p class="error">SQL Error</p>';
                }
                else{
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if (mysqli_num_rows($resultl) > 0){
                        while ($row = mysqli_fetch_assoc($resultl)){
                ?>
                            <tr>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['SerialNumber'];?></td>
                                <td><?php echo $row['gender'];?></td>
                                <td hidden><?php echo $row['CardID'];?></td>
                                <td hidden><?php echo $row['CardID_select'];?></td>
                                <td  ><a href="modif.php?id=<?=$row['id']?>" class="plus" ><img  src="images/pen.png"></a></td>

                            </tr>
                            <?php
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>



</body>
</html>
