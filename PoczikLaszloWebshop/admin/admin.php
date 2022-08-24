<?php 


require "../connection.php"; 

$error = "";
$success = "";

if(isset($_POST["feltolt"])){



    $target = "../img/".basename($_FILES["termekkep"]["name"]);

    $termekkep = $_FILES["termekkep"]["name"];
    $termeknev = $_POST["termeknev"];
    $termekar = $_POST["termekar"];
    $kategoria = $_POST["kategoria"];
    $cikkszam = $_POST["cikkszam"];
    $keszlet = $_POST["keszlet"];
    $termekrovid = $_POST["termekrovid"];
    $termekhosszu = $_POST["termekhosszu"];

    if(empty($termekkep) || empty($termeknev) || empty($termekar) || empty($cikkszam) || empty($keszlet) || empty($termekrovid) || empty($termekhosszu)){

        $error = "Termék feltöltése sikertelen. Minden mező kitöltése kötelező!";
    }
    else {


        $con = mysqli_connect(host,user,pwd,dbname);
        mysqli_query($con, "SET NAMES utf8");

        $sql = "INSERT INTO termekek(kategoria,nev,cikkszam,ar,rleiras,hleiras,kep,keszlet,aktiv) VALUES ('$kategoria', '$termeknev', '$cikkszam', '$termekar', '$termekrovid', '$termekhosszu', 'img/$termekkep', '$keszlet', 1)";

        mysqli_query($con, $sql);

        move_uploaded_file($_FILES["termekkep"]["tmp_name"], $target);

        $success = "A termékfeltöltés sikerült.";
    }
    
    

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<title>🧹Porszívó webshop ~ Admin🧹</title>
</head>
<body>

    <div class="contanier">
        <div class="row justify-content-center">

        <form action="" class="form-group text-center p-5" method="post" enctype="multipart/form-data">
        
            <h2 class="mb-5">🧹Porszívó webshop ~ Termékfeltöltés🧹</h2>

            <span class="text-danger mb-3 d-block"><?php    if(!empty($error)){echo $error;}    ?></span>
            <span class="text-info mb-3 d-block"><?php    if(!empty($success)){echo $success;}    ?></span>

            <label for="">Termékkép</label>
            <input type="file" name="termekkep" class="form-control mb-5">

            <label for="">Terméknév</label>
            <input type="text" name="termeknev" class="form-control mb-5">
            
            <label for="">Termékár</label>
            <input type="text" name="termekar" class="form-control mb-5">

            <label for="">Kategória</label>
            <select name="kategoria" class="form-control mb-5">
                <?php

                    $con = mysqli_connect(host,user,pwd,dbname);
                    mysqli_query($con, "SET NAMES utf8");

                    $sql = "SELECT * FROM kategoriak ORDER BY katsorrend ASC";

                    $result = mysqli_query($con, $sql);

                    while($row = mysqli_fetch_array($result)){

                        $id = $row["id"];
                        $katnev = $row["katnev"];
                
                        echo "
                        
                        <option value='$id'>".$katnev."</option>
                        
                        
                        ";
                    }

                ?>
            </select>

            <label>Cikkszám</label>
            <input type="text" name="cikkszam" class="form-control mb-5">

            <label for="">Készlet</label>
            <input type="text" name="keszlet" class="form-control mb-5">

            <label for="">Termék rövid leírása</label>
            <br>
            <input type="text" name="termekrovid" class="form-contol mb-5">
            <br>
            <label for="">Termék hosszú leírása</label>
            <br>
            <textarea name="termekhosszu" class="form-control mb-5" cols="60" rows="20"></textarea>

            <button type="submit" name="feltolt" class="btn btn-outline-secondary">Termék feltöltése</button>

        </form>



        </div>
    </div>


</body>
</html>