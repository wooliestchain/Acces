<?php
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_données = "nodemculog";
$con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="logs.css">
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
        <?php
        $Tarrive = mktime(9,00,00);
        $TimeArrive = date("H-i-s",$Tarrive);

        $Tleft = mktime(16,00,00);
        $Timeleft = date("H:i:s", $Tleft);

        date_default_timezone_set('Africa/Tunis');
        $d = date('2022/11/07');
        ?>
        <h2 class="time">
            Heure d'arrivée :<?php echo $TimeArrive?><br>
            Heure de départ :<?php echo $Timeleft?>
        </h2>
        <h1 class="logs_list">Liste des entrées du <?php echo $d?></h1>
        <div class="table_logs_list">
            <table class="table_logs">
                <thead class="table_logs_primary">
                <tr>
                    <td class="info_logs">ID</td>
                    <td class="info_logs">Nom</td>
                    <td class="info_logs">CardID</td>
                    <td class="info_logs" >Numéro</td>
                    <td  class="info_logs">Date</td>
                    <td  class="info_logs">Heure d'entrée</td>
                    <td  class="info_logs">Heure de sortie</td>
                    <td  class="info_logs">Appéciation</td>
                    <td  class="info_logs" hidden>Batiment</td>
                </tr>
                </thead>
                <tbody class="table_logs_secondary">
                <?php





                //Connect to database
                $nom_serveur = "localhost";
                $utilisateur = "root";
                $mot_de_passe = "";
                $nom_base_données = "nodemculog";
                $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);

                date_default_timezone_set('Africa/Tunis');
                $d = date('2022/11/07');

                $Tarrive = mktime(9,00,00);
                $TimeArrive = date("H-i-s",$Tarrive);

                $Tleft = mktime(16,00,00);
                $Timeleft = date("H:i:sa", $Tleft);

                if (!empty($_POST['seldate'])) {
                    $seldate = $_POST['date'];
                }
                else{
                    $seldate = $d;
                }



                $sql = "SELECT * FROM logs WHERE DateLog='$seldate' ORDER BY id DESC";
                $result=mysqli_query($con,$sql);

                if (mysqli_num_rows($result) > 0)
                {
                while ($row = mysqli_fetch_assoc($result))
                {
                ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
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

                ?>
                </tbody>
            </table>
        </div>
    </section>


</body>
</html>