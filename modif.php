<?php

//connexion à la base de données
include_once "manage-users.php";
//on récupère le id dans le lien
$id = $_GET['id'];

//requeter pour afficher les infos d'un employé
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_données = "nodemculog";
$con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);

//$req = mysqli_query($con,"SELECT * FROM users WHERE id = $id" );
//$row = mysqli_fetch_assoc($req);
//verifier que le boutton ajoute a bien été cliqué
if(isset($_POST['button-valider-modif'])){
    //echo "vous avez cliqué sur le
    //extraction des infos envoyés dans les variables par la méthode POST
    extract($_POST);
    //verfier que tous les champs int été remplis
    if(isset($id1) && isset($name1) && isset($serial1) && isset($drone1) &&isset($card_id1) && isset($card_id_select1)){
        //requete de modification
        $req = mysqli_query($con, "UPDATE users SET username='$name1', SerialNumber='$serial1', gender='$drone1', CardID='$card_id1', CardID_select='$card_id_select1' WHERE id=$id1");
        if($req){//si la requete a été effectuée avec succés,on fait une redirection
            header("location:index.php");
        }else{//si non
            $message = "Emplpyé non modifié";
        }
    }else{
        //si non
        $message = "Veuillez remplir tous les champs!";
    }
}
?>