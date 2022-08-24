<?php   require "header.php";   ?>

    <div id="top">
        <?php   require "menu.php";     ?>
    </div>

    <div id="left">
        <?php   require "kategoria.php";    ?>
    </div>
    
    <div id="right">
        
        <div id="sort">
            <a href="termekek.php?sort=price_asc"> Ár szerint növekvő <i class="fas fa-sort-amount-up-alt"></i> </a>
            <a href="termekek.php?sort=price_desc"> Ár szerint csökkenő <i class="fas fa-sort-amount-down"></i> </a>
            <a href="termekek.php?sort=newest"> Legújabb termék <i class="fas fa-calendar-plus"></i> </a>
            <a href="termekek.php?sort=best"> Legnépszerűbb termék <i class="far fa-star"></i> </a>
        </div>

        <?php

            $con = mysqli_connect(host,user,pwd,dbname);
            mysqli_query($con, "SET NAMES utf8");

            if(isset($_GET["katid"])){

                $katid = $_GET["katid"];

                $sql = "SELECT * FROM termekek WHERE kategoria='$katid'";
            }
            else if(isset($_GET["sort"])){

                $sort = $_GET["sort"];

                switch($sort){

                    case "price_asc":
                        $sql = "SELECT * FROM termekek ORDER BY ar ASC";
                    break;

                    case "price_desc":
                        $sql = "SELECT * FROM termekek ORDER BY ar DESC";
                    break;

                    case "newest":
                        $sql = "SELECT * FROM termekek ORDER BY id ASC";
                    break;

                    case "best":
                        $sql = "SELECT * FROM termekek ORDER BY megtekintes DESC";
                    break;
                }


            }
             else{

                $sql = "SELECT * FROM termekek ORDER BY id DESC";
             }

             $result = mysqli_query($con, $sql);

             if($result != false){
                while($row = mysqli_fetch_array($result)){

                    $id = $row["id"];
                    $termeknev = $row["nev"];
                    $termekar = $row["ar"];
                    $termekkep = $row["kep"];
                    $keszlet = $row["keszlet"];
    
                    echo "
    
                        <div class='termekdoboz'>
    
                            <div class='termekkep'>
                                <a href='termek.php?termekid=".$id."'>
                                    <img src='$termekkep' alt='' title='' />
                                </a>
                            </div>
    
                            <div class='termeknev'>
                                <h3>".$termeknev."</h3>
                            </div>
    
                            <div class='keszlet'>
                                Készlet: ".$keszlet."
                            </div>
    
                            <div class='termekar'>
                                <em>".number_format($termekar,0,' ',' ')." Ft</em>
                            </div>
    
                            <div class='termekkosar'>
                                <a href='kosarmuvelet.php?id=".$id."&action=add'>Kosárba</a>
                            </div>
    
                        </div>
                    
                    
                    ";
                 }
             } 
             else {
                 
                echo "<div class='termekdoboz'>
                <h3>Rendezési hiba!</h3>
                </div>";
             }

             

        ?>



    </div>
    



</body>
</html>