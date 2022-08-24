<?php   require "header.php";   ?>

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

            if(isset($_GET["termekid"])){

                $termekid = (int)$_GET["termekid"];

                $sql = "SELECT * FROM termekek WHERE id='$termekid'";
            }
            else{
                header("Location: termekek.php");
            }

            $result = mysqli_query($con, $sql);

            if($result){
                //Megtekintes noveles
                $sql = "UPDATE termekek SET megtekintes = megtekintes + 1 WHERE id = '" . $termekid . "' LIMIT 1";
                mysqli_query($con, $sql);

                //Listázás
                while($row = mysqli_fetch_array($result)){

                    $id = $row["id"];
                    $termekkep = $row["kep"];
                    $termeknev = $row["nev"];
                    $termekar = $row["ar"];
                    $cikkszam = $row["cikkszam"];
                    $keszlet = $row["keszlet"];
                    $rovid = $row["rleiras"];
                    $hosszu = $row["hleiras"];
    
                    echo "
    
                        <div id='termekkep'>
                            <img src='$termekkep' alt='' title='' />
                        </div>
    
                        <div id='termekadatok'>
    
                            <div id='termeknev'>
                                <h2>".$termeknev."</h2>
                            </div>
    
                            <div id='termekar'>
                                <h5>".number_format($termekar,0,' ',' ')." Ft</h5>
                            </div>
    
                            <div id='rovid'>
                                <p>".$rovid."</p>
                            </div>
    
                            <div id='cikkszam'>
                                <strong>Cikkszám: </strong>".$cikkszam."
                                <strong>Készlet: </strong>".$keszlet."
                            </div>
    
                            <div id='termekkosar'>
                                <a href='kosarmuvelet.php?id".$id."&action=add'>Add a kosárhoz!</a>
                            </div>
    
                        </div>
    
                        <div id='hosszu'>
                            <h4>Termék részletes leírása:</h4>
                            <p>".$hosszu."</p>
                        </div>
    
    
    
                    ";
                }
            }

             




        ?>
    </div>
    



</body>
</html>