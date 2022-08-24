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

            $sql = "SELECT * FROM tajekoztato";

            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)){

                $cim = $row["cim"];
                $content = $row["content"];

                echo "
                
                <h3 class=\"mb-5 text-center\">".$cim."</h3>
                <div><em>".$content."</em></div>
                
                ";
            }


        ?>




    </div>
    



</body>
</html>