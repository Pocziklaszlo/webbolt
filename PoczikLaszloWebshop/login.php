 <?php

    require "connection.php";

    session_start();

    $error="";

    if(isset($_POST["login"])){

        $user = $_POST["user"];
        $pwd = $_POST["pwd"];

        if(empty($user) || empty($pwd)){

            $error = "A belépéshez minden mező kitöltése kötelező!";
        }
        else{

            $con = mysqli_connect(host,user,pwd,dbname);
            mysqli_query($con, "SET NAMES utf8");

            $sql = "SELECT user,pwd FROM adatok WHERE user='$user' AND pwd=sha1('$pwd')";

            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) == 1){

                $_SESSION["logged"] = true;
                $_SESSION["user"] = $user;
                
                header("Location: index.php");
            }
            else{

                $error = "A felhaasználónév és jelszó páros nem megfelelő!";
            }
        } 
    
    } else if(isset($_GET['logout'])){
        unset($_SESSION["logged"]);
        unset($_SESSION["user"]);
        session_destroy();
        header('Location: index.php');
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
 <title>🧹 Porszívó webshop ~ Bejelentkezés  🧹</title>
 </head>
 <body>

    <div class="container">
        <div class="row justify-content-center">

        <form action="" method="post" class="form-group text-center p-5">

            <h3 class="mb-5">🧹 Porszívó webshop ~ Bejelentkezés  🧹</h3>
        
            <span class="text-danger d-block mb-5"><?php    if(!empty($error)){echo $error;}    ?></span>

            <label for="">Felhasználónév</label>
            <input type="text" name="user" class="form-control mb-5">

            <label for="">Jelszó</label>
            <input type="password" name="pwd" class="form-control mb-5">

             <button type="submit" name="login" class="btn btn-outline-secondary mb-5">Bejelentkezés</button>
            <br>
             <a href="reg.php">Nincs még fiókod? Regisztrálj!</a>


        </form>


        </div>


     </div>
 

 </body>
 </html>