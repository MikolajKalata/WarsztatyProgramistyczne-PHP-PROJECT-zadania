<?php
include("../model/User.php");
session_start();

if(isset($_POST["wyslij"])){
    $fileName = $_FILES["upload"]["tmp_name"];
    if ($_FILES["upload"]["size"] > 0) {

        $file = fopen($fileName, "r");
        $userList = array();
        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {

            $user = new User($column[0], $column[1], $column[2], $column[3],
                $column[4], $column[5], $column[6], $column[7]);

            array_push($userList, $user);
        }
        $_SESSION["upload"] = "true";
    }
}

        if (!empty($_SESSION["login"])) {
            include("../view/adminPanel.php");
        }

        elseif ($_POST["login"] == "admin" &&
            $_POST["pass"] == "admin") {

            $_SESSION["login"] = "admin";
            include("../view/adminPanel.php");
        }

        else {
            echo "Nieprawidlowe dane <a href='../adminlog.html'> Wroc </a>";
        }

?>