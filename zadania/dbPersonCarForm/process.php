<?php
include ("Queries.php");

$servername = "localhost";
$username = "root";
$password = "hasloBAZA20157";
$dbname = "stepik";

if (isset($_POST["delete"])){
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->query(Queries::deleteCarbyID($_POST["delete"]));
    $conn->close();
}

elseif (isset($_POST["edit"])){
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = $conn->query(Queries::getAllByCarID($_POST["edit"]));
    $conn->close();
}

if (!empty($sql)){
    $result = mysqli_fetch_assoc($sql);
    //echo substr($result['Cars_day_of_buy'],0,-3)?>
    <html>
    <body>
    <form action="#", method="post">
        <legend>EDYTUJ DANE</legend>
        <label>Imie: </label><input type="text" name="fname" value="<?php echo $result['Person_firstname']?>" required>
        <label>Nazwisko: </label><input type="text" name="sname" value="<?php echo $result['Person_secondname']?>" required>
        <label>Model: </label><input type="text" name="model" value="<?php echo $result['Cars_model']?>" required>
        <label>Cena: </label><input type="number" step="0.01" name="cena" value="<?php echo $result['Cars_price']?>" required>
        <label>Data kupna: </label><input type="datetime-local" name="data" value="<?php echo substr($result['Cars_day_of_buy'],0,-3)?>" required>
    </form>
    </body>
    </html>
<?php
}


if (isset($_POST["model"])){
    $name = $_POST['fname'];
    $secname = $_POST['sname'];
    $model = $_POST['model'];
    $price = $_POST['cena'];
    $dateob = $_POST['data'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "UPDATE Person SET Person_firstname=$name,
                  SET Person_secondname=$secname;";
    $sqlCar = "UPDATE Cars SET Cars_model=$model,
                  SET Cars_price=$price
                  SET Cars_day_of_buy=$dateob;";
    echo "zauktalizaowano";
    echo "<a href='manageDB.php'>powrot</a>";
}
?>