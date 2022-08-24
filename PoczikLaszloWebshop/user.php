<?php require "header.php"; ?>
<div id="top">
    <?php   require "menu.php";     ?>
</div>

<div id="left">
    <?php   require "kategoria.php";    ?>
</div>
    
<div id="right">

    <?php 
        $con = mysqli_connect(host,user,pwd,dbname);
        mysqli_query($con, "SET NAMES utf8");

        $sql = "SELECT t.nev,t.cikkszam,t.ar,t.hleiras,t.kep,rt.db  FROM vevok v 
                INNER JOIN rendelesek r ON r.vevoid=v.id
                INNER JOIN rend_term rt ON rt.rendelesid=r.id
                INNER JOIN termekek t ON t.id=rt.termekid
                WHERE v.felh = '" . mysqli_real_escape_string($con,trim($_SESSION['user'])) . "'";

        $result = mysqli_query($con,$sql);

        if($result){
            echo "<h1 class='text-center text-secondary mb-3'>🧹 Rendelt termékeid 🧹</h1>";
            echo "<table class='table table-center table-striped table-light mb-3 p-5'>";

            while($row = mysqli_fetch_array($result)){

                echo '<tr>
                        <th>Terméknév</th>
                        <th>Cikkszám</th>
                        <th>Termék ára</th>
                        <th>Termék leírása</th>
                        <th>Termék képe</th>
                        <th>Rendelt darabszám</th>
                    </tr>';

                echo '<tr>
                        <td>'.$row['nev'].'</td>
                        <td>'.$row['cikkszam'].'</td>
                        <td>'.$row['ar'].'</td>
                        <td>'.$row['hleiras'].'</td>
                        <td><img src='.$row['kep'].'></td>
                        <td>'.$row['db'].'</td>

                    </tr>';
            }

        echo "</table>";
    } 
    else {

        echo "<h2 class='text-danger mb-3'>Nincsenek rendelt termékeid!</h2>";
    }

    

