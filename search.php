<?php
include 'users.php';
//verifier que le boutton ajoute a bien été cliqué
if(isset($_GET['chercher'])){
    //echo "vous avez cliqué sur le
    //extraction des infos envoyés dans les variables par la méthode POST
    extract($_GET);
    //verfier que tous les champs int été remplis
    if(isset($user_nom) ){
        //connexion à la base de données
        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_base_données = "nodemculog";
        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
        //requeter d'ajout
        $req = mysqli_query($con,"SELECT username, SerialNumber, gender  FROM users WHERE username='$user_nom' " );
        if($req){//si la requete a été effectuée avec succés,on fait une redirection
            echo 'username';
            echo 'SerialNumber';
            echo 'gender';
        }else{//si non
            $message = "Employé non existant";
        }
    }else{
        //si non
        $message = "Veuillez remplir tous les champs!";
    }
}
?>