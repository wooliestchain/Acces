
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
    <link rel="stylesheet" href="main_page.css">
</head>
<body>
    <header>
        <div class="header">
            <h1><img src="poste.jpg" alt=""></h1>
        </div>

        <div class="topnav">
            <a href="users.php">Utilisateurs</a>
            <a href="manage-users.php">Gestion des utilisateurs</a>
            <a href="users_log.php">Entrée des utilisateurs</a>
            <a>Se deconnecter</a>
        </div>
        <div class="up_info1 alert-danger"></div>
        <div class="up_info2 alert-success"></div>
    </header>

    <main>
        <section>
            <h1 class="user_list">Liste des utilisateurs</h1>
            <div class="table_list">
                <table class="table">
                    <thead class="table_primary">
                    <tr>
                        <td>ID|NOM</td>
                        <td>Numéro</td>
                        <td>Genre</td>
                        <td>UID</td>
                        <td>Date</td>
                        <td>Appareil</td>
                    </tr>
                    </thead>
                    <tbody class="table_secondary">
                    <?php
                    //Connect to database
                    $nom_serveur = "localhost";
                    $utilisateur = "root";
                    $mot_de_passe = "";
                    $nom_base_données = "acces";
                    $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);

                    $sql = "SELECT * FROM users WHERE add_card=1 ORDER BY id DESC";
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
                                <TR>
                                    <TD><?php echo $row['id']; echo" | "; echo $row['username'];?></TD>
                                    <TD><?php echo $row['serialnumber'];?></TD>
                                    <TD><?php echo $row['gender'];?></TD>
                                    <TD><?php echo $row['card_uid'];?></TD>
                                    <TD><?php echo $row['user_date'];?></TD>
                                    <TD><?php echo $row['device_dep'];?></TD>
                                </TR>
                                <?php
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <?php echo "<p class ='message'> Bonjour " .  $_SESSION['email'] . "</p>"; ?>
</body>
</html>