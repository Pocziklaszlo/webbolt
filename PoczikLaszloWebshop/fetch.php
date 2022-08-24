<?php

    require "connection.php";

    $con = mysqli_connect(host,user,pwd,dbname);
    mysqli_query($con, "SET NAMES utf8");

    $keres = $_POST["keres"];

    $sql = "SELECT * FROM termekek WHERE nev LIKE '%$keres%'";

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0){

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
                        ";
                    }
        
    } else{

        echo "<h3 class='text-danger'>Nincs ilyen termék!</h3>";
    }


