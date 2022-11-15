<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="profil.css">
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

    <section>
        <h1 class="user_list">Informations de l'employé</h1>
        <div class="table_list">
            <table class="table">
                <thead class="table_primary">
                <tr>
                    <td class="info">NOM</td>
                    <td class="info">Numéro</td>
                    <td class="info">Genre</td>
                    <td class="info" hidden>UID</td>
                    <td  class="info" hidden>UID Select</td>
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
                $id = $_GET['id'];
                $username = $_GET['username'];



                $sql = "SELECT * FROM users WHERE id=$id and username=$username";
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
                            </tr>
                            <?php
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>

        <h1 class="user_list">Historique des entrées</h1>
        <div class="table_list">
            <table class="table">
                <thead class="table_primary">
                <tr>
                    <td class="info">Carte</td>
                    <td class="info">Nom</td>
                    <td class="info">Numéro</td>
                    <td class="info">Date</td>
                    <td class="info">Heure d'entrée</td>
                    <td class="info">Heure de sortie</td>
                    <td class="info" >Appréciation</td>
                    <td  class="info" hidden>Numéro de batiment</td>
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
                $username = $_GET['username'];


                $sql = "SELECT * FROM logs WHERE username=$username";
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
                                <td><?php echo $row['CardNumber'];?></td>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['SerialNumber'];?></td>
                                <td><?php echo $row['DateLog'];?></td>
                                <td><?php echo $row['TimeIn'];?></td>
                                <td><?php echo $row['TimeOut'];?></td>
                                <td><?php echo $row['UserStat'];?></td>
                                <td hidden><?php echo $row['building_number'];?></td>
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