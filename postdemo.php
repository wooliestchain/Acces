<?php
//Connect to database


$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_données = "nodemculog";
$conn = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
//**********************************************************************************************
//Get current date and time
date_default_timezone_set('Africa/Tunis');
$d = date("Y-m-d");
$t = date("H:i:sa");
//**********************************************************************************************
$Tarrive = mktime(01,30,00);
$TimeArrive = date("H:i:sa", $Tarrive);
//**********************************************************************************************
$Tleft = mktime(02,30,00);
$Timeleft = date("H:i:sa", $Tleft);
//**********************************************************************************************
$suspect = date("08:00:00");
$suspect_late = date("22:00:00");
$suspect_late_1 = date("00:00:00");
if(!empty($_GET['test'])){
    if($_GET['test'] == "test"){
        echo "The Website is online";
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
            //An existed card has been detected for Login or Logout
            if (!empty($row['username'])){
                $Uname = $row['username'];
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
                    //Login


                    if (!$row = mysqli_fetch_assoc($resultl)){

                        if ($Tarrive <= $TimeArrive) {
                            $UserStat = "Arrivé à l'heure";
                        }
                        else{
                            $UserStat = "Arrivé trop tôt";
                            /*$msg = "L'employé $Uname est arrivé à une heure suspecte";

// use wordwrap() if lines are longer than 70 characters
                            $msg = wordwrap($msg, 70);

// send email
                            mail("levyren38@gmail.com", "Entrée suspecte", $msg);*/
                        }
                        $sql = "INSERT INTO logs (CardNumber, username, SerialNumber, DateLog, TimeIn, UserStat) VALUES (? ,?, ?, CURDATE(), CURTIME(), ?)";
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
                    //Logout
                    else {

                        if ($t >= $Timeleft && $row['TimeIn'] <= $TimeArrive) {
                            $UserStat = "Arrivé et départ dans les temps";
                        }
                        elseif ($t < $Timeleft && $row['TimeIn'] > $TimeArrive){
                            $UserStat = "Arrivé en retard et parti trop tôt";
                        }
                        elseif ($t < $Timeleft && $row['TimeIn'] <= $TimeArrive) {
                            $UserStat = "Arrivé à temps et parti tôt";
                        }
                        elseif ($t >= $Timeleft && $row['TimeIn'] > $TimeArrive) {
                            $UserStat = "Arrivé en retard et parti à temps";
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
            //An available card has been detected
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

                                echo "Cardavailable";
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

                            echo "Cardavailable";
                            exit();
                        }
                    }
                }
            }
        }
        //*****************************************************
        //New card has been added
        else{
            $Uname = "";
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

                        $sql = "INSERT INTO users (username , SerialNumber, gender, CardID, CardID_select) VALUES (?, ?, ?, ?, ?)";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_add";
                            exit();
                        }
                        else{
                            $card_sel = 1;
                            mysqli_stmt_bind_param($result, "sdssi", $Uname, $Number, $gender, $Card, $card_sel);
                            mysqli_stmt_execute($result);

                            echo "succesful";
                            exit();
                        }
                    }
                }
                else{
                    $sql = "INSERT INTO users (username , SerialNumber, gender, CardID, CardID_select) VALUES (?, ?, ?, ?, ?)";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error_Select_add";
                        exit();
                    }
                    else{
                        $card_sel = 1;
                        mysqli_stmt_bind_param($result, "sdssi", $Uname, $Number, $gender, $Card, $card_sel);
                        mysqli_stmt_execute($result);

                        echo "succesful";
                        exit();
                    }
                }
            }
        }
    }
}
//*****************************************************
//Empty Card ID
else{
    echo "Empty_Card_ID";
    exit();
}
mysqli_stmt_close($result);
mysqli_close($conn);
?>
