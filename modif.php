<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter</title>
    <link rel="stylesheet" href="modif.css">
</head>
<body>
<?php

//connexion à la base de données
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_données = "nodemculog";
$con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
//on récupère le id dans le lien
$id = $_GET['id'];
//requeter pour afficher les infos d'un employé
$req = mysqli_query($con,"SELECT * FROM users WHERE id = $id" );
$row = mysqli_fetch_assoc($req);
//verifier que le boutton ajoute a bien été cliqué
if(isset($_POST['boutton-valider-modif'])){
    //echo "vous avez cliqué sur le
    //extraction des infos envoyés dans les variables par la méthode POST
    extract($_POST);
    //verfier que tous les champs int été remplis
    if(isset($name1) && isset($serial1) && isset($drone1) && isset($card_id1) && isset($card_id_select1)){
        //requete de modification
        $req = mysqli_query($con, "UPDATE users SET username='$name1', SerialNumber='$serial1', gender='$drone1', CardID='$card_id1', CardID_select='$card_id_select1' WHERE id=$id");
        if($req){//si la requete a été effectuée avec succés,on fait une redirection
            header("manage-users.php");
        }else{//si non
            $message = "Emplpyé non modifié";
        }
    }else{
        //si non
        $message = "Veuillez remplir tous les champs!";
    }
}
?>
<div class="form">
    <a href="manage-users.php" class="back_btn"><img src="images/back.png"><span>Retour</span></a>
    <h2>Modifier l'employé : <?=$row['username']?></h2>
    <p  class="erreur_message">
        <?php
        if (isset($message)){
            echo $message;
        }
        ?>
    </p>
    <form action="" method="post">
        <label>Nom de l'employé</label><br>
        <input type="text" name="name1" id="username1" value="<?=$row['username']?>" ><br>
        <label>Numéro</label><br>
        <input type="text" name="serial1" id="serail1" value="<?=$row['SerialNumber']?>"><br>
        <label>Sexe</label><br>
        <input type="text" id="femme1" name="drone1" value="<?=$row['gender']?>"><br>
        <label>ID Carte</label><br>
        <input type="text" name="card_id1" id="serail1" value="<?=$row['CardID']?>"><br>
        <label>Carte ID Select</label><br>
        <input type="text" name="card_id_select1" id="serail1" value="<?=$row['CardID_select']?>"><br>

        <input type="submit" value="Modifier" name="boutton-valider-modif">
    </form>
</div>
</body>
</html>