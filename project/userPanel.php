<?php
include("model/User.php");

session_start();

if(!empty($_SESSION["email"]) &&
    !empty($_SESSION["pass"])){
    //just show the panel
}

elseif (!empty($_POST["login"]) &&
    !empty($_POST["pass"])){

    ////authorization with mysql(if ok, proceed) else setookie
    $_SESSION["firstname"] = "user"; /////normally from Session = user from db
    $_SESSION["email"] = "user"; ////// same above
    $_SESSION["cardType"] = "user"; ////// same above
    $_SESSION["surnname"] = "user"; ////// same above
    $_SESSION["gender"] = "user"; ////// same above
    $_SESSION["cardNum"] = "user"; ////// same above
    $_SESSION["pass"] = "user"; ////// same above

}
else{
    session_destroy();
    header("Location: index.html");
    setcookie("login", "false", time() + 3);
}
?>



    <!DOCTYPE html>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="static/css/userPanel.css">
<script src="static/js/jquery.js"></script>
<script src="static/js/userPanel.js"> </script>

<head>
    <meta charset="UTF-8">
    <title>RegCard</title>
</head>
<body>
<header>
    <div class="row bg-secondary">
        <div class="col-10 text-center">
            <a class="text-light"><img src="static/img/logo.jpg"></a>
        </div>
        <div class="col-1 text-right">
            <a href="userPanel.php"><button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                </button>
            </a>
        </div>
        <div class="col-1 text-right">
            <a href="logout.php?logout=true"><button>WYLOGUJ
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
            </button>
            </a>
        </div>
    </div>
</header>


<div class="container">

    <div class="row">
        <div  class="col-6 text-left"><div class="btn">Edycja danych</div></div>
        <div class="col-6 text-right"><div class="btn">Usuń konto</div></div>
    </div>

    <div class="Welcome p-4">
        <p>Witaj, <?php echo ($_SESSION["firstname"]);?>!</p>
        <p>Możesz tutaj sprawdzić swoje dane, edytować je lub usunąć konto.</p>
        <br>
        <div class="border border-secondary">
            <div class="row"><label class="col-6 border-right border-secondary">Imię: <?php echo $_SESSION["firstname"]?></label><label class="col-6">Nazwisko: <?php echo $_SESSION["surnname"]?></label>
            </div>
            <div class="row "><label class="col-6 border-right border-secondary">Adres e-mail: <?php echo $_SESSION["email"]?></label><label class="col-6">Płeć: <?php echo $_SESSION["gender"]?></label>
            </div>
            <div class="row"><label class="col-6 border-right border-secondary">Typ karty: <?php echo $_SESSION["cardType"]?></label><label class="col-6">Numer karty: <?php echo $_SESSION["cardNum"]?></label>
            </div>
            <div class="row"> <label class="col-8"></label><?php echo "<img src=\"static/img/american.jpg\">"?></div>
        </div>
    </div>


    <div class="0 form p-4">
        <form action="editForm.php" method="post">
            <label>Imię:</label>
            <input type="text" name="firstname" id="name" class="form-control" placeholder="Imię" value=<?php echo "\"" . $_SESSION["firstname"] . "\""?>>
            <br>
            <label>Nazwisko:</label>
            <input type="text" name="surname" id="surname" class="form-control" placeholder="Nazwisko" value=<?php echo "\"" . $_SESSION["surnname"] . "\""?>>
            <br>
            <label>Adres e-mail:</label>
            <input type="text" name="mail" id="mail" class="form-control" placeholder="Adres e-mail" value=<?php echo "\"" . $_SESSION["email"] . "\""?>>
            <br>
            <label>Hasło:</label>
            <input type="password" name="pass"  id="pass" class="form-control" placeholder="Hasło" value=<?php echo "\"" . $_SESSION["pass"] . "\""?>>
            <p style="font-size: 10px; color: forestgreen"> Hasło musi składać się z co najmniej 6 znaków, co  najmniej 1 wielkiej litery, 1 małej litery oraz cyfry.</p>
            <label>Płeć:</label>
            <select class="form-control" name="gender" id="gender">
                <option value=<?php echo "\"" . $_SESSION["gender"] . "\""?> selected disabled><?php echo $_SESSION["gender"]?></option>
                <option value="male">Mężczyzna</option>
                <option value="female">Kobieta</option>
                <option value="other">Inne</option>
            </select>
            <br>
            <label>Typ karty:</label>
            <select class="form-control" name="cardType" id="cardtype">
                <option value=<?php echo "\"" . $_SESSION["cardType"] . "\""?> selected disabled><?php echo $_SESSION["cardType"]?></option>
                <option value="Debetowa">Debetowa</option>
                <option value="Kredytowa">Kredytowa</option>
                <option value="Obciążeniowa">Obciążeniowa</option>
            </select>
            <br>
            <label>Numer karty:</label>
            <input type="text" class="form-control" name="cardNum" id="cardnum" placeholder="Numer karty" value=<?php echo "\"" . $_SESSION["cardNum"] . "\""?>>
            <br>
            <input type="submit" class="btn-success" value="Zatwierdź" id="formReg">
        </form>
    </div>

    <div class="1 form p-4">
        <p>Czy aby napewno chcesz usunąć konto? </p>
        <input type="submit" class="btn-danger" value="Usuń" id="formReg">
    </div>


</div>


<footer>
    <div class="row bg-secondary">
        <div class="col-11 text-center">
            <a class="text-light"><img src="static/img/logo.jpg"></a>
        </div>
    </div>
</footer>
</body>
</html>