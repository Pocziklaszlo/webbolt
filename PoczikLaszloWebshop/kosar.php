<?php   require "header.php";  ?>

    <div id="top">
        <?php   require "menu.php";     ?>
    </div>

    <div id="left">
        <?php   require "kategoria.php";    ?>
    </div>
    
    <div id="right">
        <h2 id="kosar_cim">🧹 Kosár tartalma 🧹</h2>

        <div class="container" style="max-width: 70%">
            <div class="row justify-content-center">

                <table class="table table-light table-striped text-center">
                    <tr>
                        <th>Azonosító</th>
                        <th>Terméknév</th>
                        <th>Ára</th>
                        <th>Darabszám</th>
                        <th>Cikkszám</th>
                        <th>Érték</th>
                        <th> <a href="kosarmuvelet.php?action=empty"><i class="fas fa-trash-alt"></i></a> </th>
                    </tr>

                    <?php

                        $vegosszeg = 0;

                        if(isset($_SESSION["cart"])){

                            foreach($_SESSION["cart"] as $product_id => $db){

                                $con = mysqli_connect(host,user,pwd,dbname);
                                mysqli_query($con, "SET NAMES utf8");

                                $sql = "SELECT * FROM termekek WHERE id='$product_id'";

                                $result = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_array($result)){

                                    $termeknev = $row["nev"];
                                    $bruttoar = $row["ar"];
                                    $cikkszam = $row["cikkszam"];
                                    $ertek = $bruttoar * $db;
                                    
                                    echo "
                                        <tr>
                                            <td>".$product_id."</td>
                                            <td>".$termeknev."</td>
                                            <td>".number_format($bruttoar,0,' ',' ')."</td>
                                            <td>".$db."</td>
                                            <td>".$cikkszam."</td>
                                            <td>".$ertek."</td>
                                            <td>
                                                <a href='kosarmuvelet.php?id=".$product_id."&action=add'><i class='fas fa-plus'></i></a>

                                                <a href='kosarmuvelet.php?id=".$product_id."&action=remove'><i class='fas fa-minus'></i></a>
                                            </td>
                                        </tr>
                                    
                                    ";

                                    $vegosszeg += $ertek;
                                }
                            }
                        }
                        else{

                            echo "<h3 class='text-secondary text-center'>Üres a kosarad!</h3>";
                        }



                    ?>

                    <tr>
                        <td text-align="right" colspan="7">
                            <strong>Végösszeg: </strong> <em><?php   echo number_format($vegosszeg,0,' ',' ');   ?> Ft</em>
                        </td>
                    </tr>
                </table>
                <?php

                if(isset($_SESSION["logged"])){

                    ?>
                    <a href="megrendeles.php" id="megrendeles_btn">Megrendelem</a>
                    <?php
                }
                else{

                        ?>
                    <a href="login.php" id="megrendeles_btn">Rendelés leadásához kérjük jelentkezzen be!</a>
                    <?php
                }

                    ?>
                
            </div>
        </div>
      


    </div>
    



</body>
</html>