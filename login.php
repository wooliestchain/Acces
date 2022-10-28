<?php
//Nous allons démarrer la session avant toute chose
session_start();
if (isset($_POST['boutton-valider'])) { // Si on clique sur le boutton , alors :
    //Nous allons verifiér les informations du formulaire
    if (isset($_POST['email']) && isset($_POST['password'])) { //On verifie ici si l'utilisateur a rentré des informations
        //Nous allons mettres l'email et le mot de passe dans des variables
        $email = $_POST['email'];
        $mdp = $_POST['password'];
        $erreur = "";
        //Nous allons verifier si les informations entrée sont correctes
        //Connexion a la base de données
        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_base_données = "acces";
        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
        //requete pour selectionner  l'utilisateur qui a pour email et mot de passe les identifiants qui ont été entrées
        $req = mysqli_query($con, "SELECT * FROM admins WHERE admin_email = '$email' AND admin_password ='$mdp' ");
        $num_ligne = mysqli_num_rows($req);//Compter le nombre de ligne ayant rapport a la requette SQL
        if ($num_ligne > 0) {
            header("Location:main_page.php");//Si le nombre de ligne est > 0 , on sera redirigé vers la page bienvenu
            // Nous allons créer une variable de type session qui vas contenir l'email de l'utilisateur
            $_SESSION['email'] = $email;
        } else {//si non
            $erreur = "Adresse Mail ou Mots de passe incorrectes !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>


<header>

    <div class="logo">
        <h1><img src="poste.jpg" alt=""></h1>
    </div>
</header>
<main>
    <div class="login_page">
        <div class="login">


            <div class="form">
                <form action="" method="POST">
                    <input type="email" name="email" id="email1" placeholder="Entrer votre mail"><br>
                    <input type="password" name="password" id="pass1" placeholder="Entrez votre mot de passe"><br>
                    <input type="submit" value="Valider" name="boutton-valider">
                    <p>Mot de passe oublié? <span class="new_pass">Réinitialiser le ici!</span></p>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>