<?php
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_données = "nodemculog";
$con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);


if(!$con){
    echo "Erreur".mysqli_connect_error();
    exit();
}

echo "Connexion réussie";

$card = $_GET["CardID"];
$querry = "INSERT INTO users (CardID) VALUES ('$card')";
$result = mysqli_query($con,$querry);

echo "Reussie"

?>