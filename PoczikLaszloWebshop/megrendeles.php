<?php   require "header.php";   ?>

<div id="top">
    <?php   require "menu.php";     ?>
</div>

<div id="left">
    <?php   require "kategoria.php";    ?>
</div>

<div id="right">
    <h2>🧹 Megrendelés összesítése 🧹</h2>
    <div class="container" style="may-width: 70%">
        <div class="row justify-content-center">
            <table class="w-50 table table-light table-striped text-center">
                    <tr>
                        <th>Azonosító</th>
                        <th>Terméknév</th>
                        <th>Ára</th>
                        <th>Darabszám</th>
                        <th>Cikkszám</th>
                        <th>Érték</th>
                    </tr>

                    <?php

                        $vegosszeg = 0;

                        if(isset($_SESSION["cart"])){

                            foreach($_SESSION["cart"] as $product_id => $db){

                                $con = mysqli_connect(host,user,pwd,dbname);
                                mysqli_query($con, "SET NAMES utf8");

                                $sql = "SELECT * FROM termekek WHERE id='$product_id'";

                                $result = mysqli_query($con,$sql);

                                while($row = mysqli_fetch_array($result)){

                                    $termeknev = $row["nev"];
                                    $bruttoar = $row["ar"];
                                    $cikkszam = $row["cikkszam"];
                                    $ertek = $bruttoar * $db;

                                    echo "

                                        <tr>
                                            <td>".$product_id."</td>
                                            <td>".$termeknev."</td>
                                            <td>".number_format($bruttoar,0,' ',' ')." Ft</td>
                                            <td>".$db."</td>
                                            <td>".$cikkszam."</td>
                                            <td>".number_format($ertek,0,' ',' ')." Ft</td>
                                        </tr>
                                    
                                    ";

                                    $vegosszeg += $ertek;
                                }
                            }
                        }

                    ?>
                    
                    <tr>
                        <td text-align="right" colspan="6">
                            <strong>Végösszeg: </strong> <em><?php echo number_format($vegosszeg,0,' ',' ');  ?> Ft</em>
                        </td>
                    </tr>



            </table>
        </div>
    </div>

    <?php

            
    $error="";
    $error2="";
    $success="";
    if(isset($_POST["megrendel"]) && (!isset($_POST["check"]) || $_POST["check"] != 'on')){
        $error = "Kérjük, fogadd el a feltételeket";
    }
    else if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 1)){

        $nev = $_POST["nev"];
        $email = $_POST["email"];
        $telefon = $_POST["telefon"];
        $szcim = $_POST["szcim"];
        $szmod = $_POST["szmod"];
        $fizmod = $_POST["fizmod"];
        $user = $_SESSION["user"];

        if(empty($nev) || empty($email) || empty($telefon) || empty($szcim)){

            $error = "Rendelés leadása sikertelen. Minden mező kitöltése kötelező!";
        } else if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 0)){

            /*$nev = $_POST["nev"];
            $email = $_POST["email"];
            $telefon = $_POST["telefon"];
            $szcim = $_POST["szcim"];*/

            $error2 = "A vásárlási feltétlek elfogadása kötelező!";

            if(empty($nev) || empty($email) || empty($telefon) || empty($szcim)){

                $error = "Rendelés leadásához minden mező kitöltése kötelező!";
            }

        } else{

            $con = mysqli_connect(host,user,pwd,dbname);
            mysqli_query($con, "SET NAMES utf8");

            $sql = "INSERT INTO vevok(nev,email,cim,telefon,pw,szcim,felh) VALUES('$nev', '$email', '$szcim', '$telefon', '', '$szcim', '$user')";

            mysqli_query($con, $sql);

            $utolsovevoid = "SELECT id FROM vevok ORDER BY id DESC LIMIT 1";
            
            $result = mysqli_query($con, $utolsovevoid);

            $get_vevoid = mysqli_fetch_array($result);
            
            $kapottvevoid = $get_vevoid[0];

            $sql2 = "INSERT INTO rendelesek(vevoid,szallitas,fizmod,datum,statusz,bosszeg) VALUES('$kapottvevoid', '$szmod', '$fizmod', NOW(), 'függőben', '$vegosszeg')";

            mysqli_query($con, $sql2);

            $success = "A rendelést rögzítettük!";

            if(!empty($success)){

                unset($_SESSION["cart"]);
                header('Location: ' . $_SERVER['REQUEST_URI']);
            }

            if(isset($_SESSION["cart"])){
                $utolsorendelesid = "SELECT id FROM rendelesek ORDER BY id DESC LIMIT 1";

                $result2 = mysqli_query($con, $utolsorendelesid);

                $get_rendelesid = mysqli_fetch_array($result2);
        
                $kapottrendelesid = $get_rendelesid[0];

                foreach($_SESSION["cart"] as $product_id => $db){

                    $sql3 = "INSERT INTO rend_term(rendelesid,termekid,db) VALUES('$kapottrendelesid', '$product_id', '$db')";

                    mysqli_query($con, $sql3);

                    $sql4 = "UPDATE termekek SET keszlet=keszlet-'$db' WHERE id='$product_id'";

                    mysqli_query($con, $sql4);

                }
            }

        }
    }
    ?>


    <div class="contanier" style="max-width: 70%">
        <div class="row justify-content-center">
            <form action="" method="post" class="form-group text-center p-5 w-100">

                <h4 class="text-danger mb-5"><?php  if(!empty($error)){echo $error;}    ?></h4>
                <h4 class="text-secondary mb-5"><?php   if(!empty($success)){echo $success;}    ?></h4>

                <input type="text" name="nev" placeholder="Név" class="form-control mb-3">

                <input type="email" name="email" placeholder="E-mail cím" class="form-control mb-3">

                <input type="text" name="telefon" placeholder="Telefonszám" class="form-control mb-3">

                <input type="text" name="szcim" placeholder="Szállítási cím" class="form-control mb-3">

                <select name="szmod" class="form-control mb-3">
                    <option value="gls">GLS futár</option>
                    <option value="MPL">MPL futár</option>
                    <option value="ups">UPS futár</option>
                    <option value="szemelyes">Személyes átvétel üzeltünkben</option>
                </select>

                <select name="fizmod" class="form-control mb-3">
                    <option value="obk">Online bankkártya</option>
                    <option value="utanvet">Utánvét</option>
                    <option value="utalas">Utalás</option>
                </select>

                <h4 class="text-danger mb-5"></h4>

                <p> <a href="tajekoztato.php">Vásárlási feltételek</a> </p>
                <input type="checkbox" name="check" class="d-block m-auto">

                <button type="submit" name="megrendel" id="megrendel_btn" class="mt-3">Rendelés leadása</button>



            </form>


        </div>



    </div>




</div>




</body>
</html>