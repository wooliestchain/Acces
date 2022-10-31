<?php
    date_default_timezone_set('Africa/Tunis');
    $d = date("d-m-Y");

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

    $_SESSION["exportdata"] = $seldate;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="users.css">
    <title>Document</title>
</head>
<body>

</body>
</html>
