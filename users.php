
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="utilisateurs.css">

    <title>Utilisateurs</title>
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

    <main>
        <form method="GET">
            <div class="cherche">
            <input type="search" name="q" placeholder="Nom de l'employé..." />
            <input type="submit" value="chercher" />
            </div>
        </form>
    </main>
    <section>
        <h1 class="users_list">Liste des Employés</h1>
        <div class="table_users_list">
            <table class="table_users">
                <thead class="table_users_primary">
                <tr>
                    <td class="info_users" hidden>ID</td>
                    <td class="info_users">Nom</td>
                    <td class="info_users" >Numéro</td>
                    <td  class="info_users">Genre</td>
                    <td  class="info_users">Carte ID</td>
                    <td  class="info_users" hidden>Carte ID Select</td>
                </tr>
                </thead>
                <tbody class="table_users_secondary">
                <?php

                //Connect to database
                $nom_serveur = "localhost";
                $utilisateur = "root";
                $mot_de_passe = "";
                $nom_base_données = "nodemculog";
                $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);

                $sql = "SELECT * FROM users ORDER BY id DESC";
                $result=mysqli_query($con,$sql);

                if (mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <tr>
                            <td hidden><?php echo $row['id'];?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['SerialNumber'];?></td>
                            <td><?php echo $row['gender'];?></td>
                            <td><?php echo $row['CardID'];?></td>
                            <td hidden><?php echo $row['CardID_select'];?></td>
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