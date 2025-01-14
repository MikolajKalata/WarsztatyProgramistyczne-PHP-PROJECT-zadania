<?php
if (isset($_GET["logout"])){
    session_start();
    unset($_SESSION["login"]);
    unset($_POST["login"]);
    unset($_POST["pass"]);
    unset($_SESSION["login"]);
    session_destroy();
    header("Location: index.html");
    setcookie("logout", "success", time() + 5);
    die();
}
?>

<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="../static/css/adminPanel.css">
<script src="../static/js/jquery.js"></script>
<script src="../static/js/sortElements.js"></script>
<script src="../static/js/adminPanel.js"> </script>



<head>
    <meta charset="UTF-8">
    <title>RegCard</title>
</head>

<body class="bg-primary">
<header>
    <div class="row bg-primary">
        <div class="col-2"><img src="../static/img/paddlelock.JPG" id="paddlelock"></div>
        <div class="col-8 text-center">
            <a class="text-light"><img src="../static/img/logo.jpg"></a>
        </div>
        <div class="col-1 right" id="logout">
            <a href="../view/adminPanel.php?logout=true"><button>WYLOGUJ
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
            </button>
            </a>
        </div>
        <div class="col-1 text-right"><img src="../static/img/paddlelock.JPG" id="paddlelock"></div>
    </div>
</header>


<div class="container bg-light rounded">

    <?php
    if (!isset($_SESSION["upload"])){
    ?>
    <div class="Welcome text-center">
        <p>Witaj w panelu administratora!</p>
        <p>Możesz tu zarządzać zarejestrowanymi użykownikami,
        dodawać nowych, a także importować i eksportować pliki.</p>
    </div>
    <?php
    }
    ?>

    <div class="row">
        <div  class="col-12 text-center "><div class="btn" id="manageUsers">Zarządzaj użytkownikami</div></div>
<!--        zaladować na wejscu baze, wyszukaj użytkownika, edytuj, usun, importuj plik, zapisz do pliku-->
    </div>

    <div class="content p-4 container">
<!--    Select * from Person load using php(link)-->

        <div class="row mb-3"><button class="btn-success" id="new">NOWY</button></div>

        <div class="row"><table class="table"><tr class="table-primary"><th>Row#</th><th>ID</th><th>Imie</th><th>Nazwisko</th><th>Email</th>
            <th>Płeć</th><th>Typ karty</th><th>Numer karty</th><th>System płatniczy</th></tr>
                <?php

                $mysqli = new mysqli(mysqlProperties::getServerName(), mysqlProperties::getUser(),
                    mysqlProperties::getPassword(), mysqlProperties::getDBname());
                $getAll = $mysqli->query(Queries::$selectAll);

                while($row = $getAll->fetch_assoc()){
                    echo "<tr>
                                        <td></td>
                                        <td>".$row["id"]."</td>
                                        <td>".$row["firstname"]."</td>
                                        <td>".$row["surname"]."</td>
                                        <td>".$row["email"]."</td>
                                        <td hidden>".$row["password"]."</td>
                                        <td>".$row["gender"]."</td>
                                        <td>".$row["cardtype"]."</td>
                                        <td>".$row["cardnum"]."</td>
                                      
                                        <td>".$row["paymentnetwork"]."</td>
                                        
                            </tr>";
                }
                ?>
</table></div>

        <div class="row mt-5">
            <div class="col-6"><button type="button" class="col-6 btn-info" id="edit">EDYTUJ</button></div>

            <div class="col-6 text-right"><form action="../controller/adminPanelController.php" method="post">
                    <input type="submit" class="col-6 btn-danger ml-5" id="delete" name="delete" value="USUŃ"></form></div>
        </div>

        <div class="row mt-5">
            <form method="post" action="../controller/adminPanelController.php" enctype="multipart/form-data">
                <div><label class="ml-5">Załaduj plik z danymi</label><input type="file" class="ml-2 mb-3" accept=".csv" name="upload" id="upload">
                    <input class="mt-2 btn btn-secondary" type="submit" value="Pokaż plik" name="showFile" id="send">
                </div>
            </form>
        </div>

        <div class="row mt-5">
            <a class="ml-5 col-11 text-right" href="../controller/adminPanelController.php?path=data.csv">
                <button class="btn btn-success">Pobierz plik z danymi</button>
            </a>
        </div>

    </div>


    <div class="row mt-1"
        <?php
    if (!isset($_SESSION["upload"])){
        echo "style=\"display: none\"";
    } ?>
    ><table class="table csvTable"><tr class="table-primary"><th>Row#</th><th>Imie</th><th>Nazwisko</th><th>Email</th>
                <th>Płeć</th><th>Typ karty</th><th>Numer karty</th><th>System płatniczy</th></tr>
                <?php

                if(isset($_POST["showFile"])) {
                         if (empty($userList)){
                            echo "<tr>Błąd przesłania pliku</tr>";
                        }
                        else{
                            foreach ($userList as $user){
                                echo "<tr>
                                        <td></td>
                                        <td>".$user->getFirstname()."</td>
                                        <td>".$user->getSurname()."</td>
                                        <td>".$user->getEmail()."</td>
                                        <td>".$user->getGender()."</td>
                                        <td hidden>".$user->getPassword()."</td>
                                        <td>".$user->getCardType()."</td>
                                        <td>".$user->getCardNum()."</td>
                                        
                                        <td>".$user->getPaymentNetwork()."</td>
                                                               
                                      </tr>";
                            }
                        }
                }
                unset($_SESSION["upload"]);
                unset($_POST["showFile"]);
                ?>

        </table>
        <div class="csvTable row mt-2 ml-5 col-11 text-right">
            <form class="mb-1 col-12 text-right" method="post", action="../controller/adminPanelController.php">
                <input type="submit" class="btn btn-success" name="sendFileToDb" value="Zapisz do bazy">
            </form>
        </div>
    </div>

    <div class="editForm">

        <div class="0 form p-4">
        <form action="../controller/editForm.php" method="post">
            <label>ID:</label>
            <input type="text" name="id" id="id" class="form-control" readonly>
            <br>
            <label>Imię:</label>
            <input type="text" name="firstname" id="name" class="form-control" placeholder="Imię">
            <br>
            <label>Nazwisko:</label>
            <input type="text" name="surname" id="surname" class="form-control" placeholder="Nazwisko">
            <br>
            <label>Adres e-mail:</label>
            <input type="text" name="mail" id="mail" class="form-control" placeholder="Adres e-mail">
            <br>
            <label>Hasło:</label>
            <input type="password" name="pass"  id="pass" class="form-control" placeholder="Hasło">
            <p style="font-size: 10px; color: forestgreen"> Hasło musi składać się z co najmniej 6 znaków, co  najmniej 1 wielkiej litery, 1 małej litery oraz cyfry.</p>
            <label>Płeć:</label>
            <select class="form-control" name="gender" id="gender">
                <option selected></option>
                <option value="Mężczyzna">Mężczyzna</option>
                <option value="Kobieta">Kobieta</option>
                <option value="Inne">Inne</option>
            </select>
            <br>
            <label>Typ karty:</label>
            <select class="form-control" name="cardType" id="cardtype">
                <option selected></option>
                <option value="Debetowa">Debetowa</option>
                <option value="Kredytowa">Kredytowa</option>
                <option value="Obciążeniowa">Obciążeniowa</option>
            </select>
            <br>
            <label>Numer karty:</label>
            <input type="text" class="form-control" name="cardNum" id="cardnum" placeholder="Numer karty">
            <br>
            <input type="submit" class="btn-success" value="Zatwierdź" id="formReg">
        </form>
    </div>
    </div>

</div>
</body>
</html>
