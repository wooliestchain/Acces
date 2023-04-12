<?php
//Connexion base de données


$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_données = "nodemculog";
$conn = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
//**********************************************************************************************
//Date et heure à l'instant t
date_default_timezone_set('Africa/Tunis');
$d = date("Y-m-d");
$t = date("H:i:sa");
//**********************************************************************************************
$Tarrive = mktime(07,30,00);
$TimeArrive = date("H:i:s", $Tarrive);
//**********************************************************************************************
$Tleft = mktime(02,30,00);
$Timeleft = date("H:i:s", $Tleft);
//**********************************************************************************************
/*$suspect = date("08:00:00");
$suspect_late = date("22:00:00");
$suspect_late_1 = date("00:00:00");*/
if(!empty($_GET['test'])){
    if($_GET['test'] == "test"){
        echo "Le site est en ligne";
        exit();
    }
}

if(!empty($_GET['CardID'])){

    $Card = $_GET['CardID'];

    $sql = "SELECT * FROM users WHERE CardID=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_card";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $Card);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            //*****************************************************
            //Carte detectée
            if (!empty($row['username'])){
                $Uname = $row['username'];
                $prename = $row['prenom'];
                $Number = $row['SerialNumber'];
                $sql = "SELECT * FROM logs WHERE CardNumber=? AND DateLog=CURDATE()";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_logs";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $Card);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    //*****************************************************
                    //Entrée


                    if (!$row = mysqli_fetch_assoc($resultl)){
                        if ($t <= $TimeArrive) {
                            $UserStat = "Arrived on time";
                        }
                        else{
                            $UserStat = "Arrived late";
                        }
                        $sql = "INSERT INTO logs (CardNumber, Name, SerialNumber, DateLog, TimeIn, UserStat) VALUES (? ,?, ?, CURDATE(), CURTIME(), ?)";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_login1";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "ssds", $Card, $Uname, $Number, $UserStat);
                            mysqli_stmt_execute($result);

                            echo "login";
                            exit();
                        }
                    }
                    //*****************************************************


                    //Sortie
                    else {
                        
                        if ($t >= $Timeleft && $row['TimeIn'] <= $TimeArrive) {
                            $UserStat = "Arrived and Left on time";
                        }
                        elseif ($t < $Timeleft && $row['TimeIn'] > $TimeArrive){   
                            $UserStat = "Arrived late and Left early";
                        }
                        elseif ($t < $Timeleft && $row['TimeIn'] <= $TimeArrive) {
                            $UserStat = "Arrived on time and Left early";
                        }
                        elseif ($t >= $Timeleft && $row['TimeIn'] > $TimeArrive) {
                            $UserStat = "Arrived late and Left on time";
                        }
                        $sql="UPDATE logs SET TimeOut=CURTIME(), UserStat=? WHERE CardNumber=? AND DateLog=CURDATE()";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert_logout1";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "sd", $UserStat, $Card);
                            mysqli_stmt_execute($result);

                            echo "logout";
                            exit();
                        }
                    }
                }
            }
            //*****************************************************
            //Une carte disponible a été detectée
            else{
                $sql = "SELECT CardID_select FROM users WHERE CardID_select=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                }
                else{
                    $card_sel = 1;
                    mysqli_stmt_bind_param($result, "i", $card_sel);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);

                    if ($row = mysqli_fetch_assoc($resultl)) {

                        $sql="UPDATE users SET CardID_select =?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert";
                            exit();
                        }
                        else{
                            $card_sel = 0;
                            mysqli_stmt_bind_param($result, "i", $card_sel);
                            mysqli_stmt_execute($result);

                            $sql="UPDATE users SET CardID_select =? WHERE CardID=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_insert_An_available_card";
                                exit();
                            }
                            else{
                                $card_sel = 1;
                                mysqli_stmt_bind_param($result, "is", $card_sel, $Card);
                                mysqli_stmt_execute($result);

                                echo "Carte disponible";
                                exit();
                            }
                        }
                    }
                    else{
                        $sql="UPDATE users SET CardID_select =? WHERE CardID=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert_An_available_card";
                            exit();
                        }
                        else{
                            $card_sel = 1;
                            mysqli_stmt_bind_param($result, "is", $card_sel, $Card);
                            mysqli_stmt_execute($result);

                            echo "Carte disponible";
                            exit();
                        }
                    }
                }
            }
        }
        //*****************************************************
        //Un nouvelle carte a été ajoutée
        else{
            $Uname = "";
            $prename = "";
            $Number = "";
            $gender= "";

            $sql = "SELECT CardID_select FROM users WHERE CardID_select=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_Select";
                exit();
            }
            else{
                $card_sel = 1;
                mysqli_stmt_bind_param($result, "i", $card_sel);
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if ($row = mysqli_fetch_assoc($resultl)) {

                    $sql="UPDATE users SET CardID_select =?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error_insert";
                        exit();
                    }
                    else{
                        $card_sel = 0;
                        mysqli_stmt_bind_param($result, "i", $card_sel);
                        mysqli_stmt_execute($result);

                        $sql = "INSERT INTO users (username , prenom, SerialNumber, gender, CardID, CardID_select) VALUES (?,?, ?, ?, ?, ?)";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_add";
                            exit();
                        }
                        else{
                            $card_sel = 1;
                            mysqli_stmt_bind_param($result, "ssdssi", $Uname, $prename, $Number, $gender, $Card, $card_sel);
                            mysqli_stmt_execute($result);

                            echo "Réussi";
                            exit();
                        }
                    }
                }
                else{
                    $sql = "INSERT INTO users (username , prenom, SerialNumber, gender, CardID, CardID_select) VALUES (?,?, ?, ?, ?, ?)";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error_Select_add";
                        exit();
                    }
                    else{
                        $card_sel = 1;
                        mysqli_stmt_bind_param($result, "ssdssi", $Uname, $prename, $Number, $gender, $Card, $card_sel);
                        mysqli_stmt_execute($result);

                        echo "Réussi";
                        exit();
                    }
                }
            }
        }
    }
}
//*****************************************************
//Id carte vide
else{
    echo "Carte_ID vide";
    exit();
}
mysqli_stmt_close($result);
mysqli_close($conn);
?>
