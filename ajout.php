<?php
include 'manage-users.php';
//verifier que le boutton ajoute a bien été cliqué
if(isset($_POST['boutton-valider-ajout'])){
    //echo "vous avez cliqué sur le
    //extraction des infos envoyés dans les variables par la méthode POST
    extract($_POST);
    //verfier que tous les champs int été remplis
    if(isset($name) && isset($serial) && isset($drone) && isset($card_id) && isset($card_id_select) ){
        //connexion à la base de données
        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_base_données = "nodemculog";
        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
        //requeter d'ajout
        $req = mysqli_query($con,"INSERT INTO users VALUES(NULL, '$name', '$serial', '$drone', '$card_id', '$card_id_select')" );
        if($req){//si la requete a été effectuée avec succés,on fait une redirection
            header("location:manage-users.php");
        }else{//si non
            $message = "Emplpyé non ajouté";
        }
    }else{
        //si non
        $message = "Veuillez remplir tous les champs!";
    }
}
?>