<?php

    require "connection.php";
    $error="";
    $success="";

    if(isset($_POST["reg"])){

        $user = $_POST["user"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];

        $uppercase = preg_match('@[A-Z]@', $pwd);
        $lowercase = preg_match('@[a-z]@', $pwd);
        $number    = preg_match('@[0-9]@', $pwd);
        $number    = preg_match('@[^A-Za-z0-9]@', $pwd);

        if(!$uppercase || !$lowercase || !$number) {
            $error = "Nem megfelelő jelszó (Nincs benne kis/nagy betű,vagy szám,vagy speciális karakter)";
          }

        if(empty($user) || empty($email) || empty($pwd)){

            $error = "Regisztráció sikertelen. Minden mező kitöltése kötelező!";
        }
        else if(strlen($pwd) < 8){

            $error = "Jelszó hossza minimum 8 karakter legyen!<br>";
        } 
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            $error = "Az e-mail cím formátuma nem megfelelő!<br>";
        }
        else if($error == ''){
            
            $con = mysqli_connect(host,user,pwd,dbname);
            mysqli_query($con, "SET NAMES utf8");

            $user_sql = "SELECT * FROM adatok WHERE user='$user'";

            $user_exist = mysqli_query($con, $user_sql);

            if(mysqli_num_rows($user_exist) > 0){

                $error = "Létező felhasználónév!";
            }
            else{

                $sql = "INSERT INTO adatok(user,email,pwd) VALUES('$user', '$email', sha1('$pwd'))";

                mysqli_query($con, $sql);

                $success = "A regisztráció sikeres!";
            }

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
 
 <title>🧹 Porszívó webshop ~ Regisztráció  🧹</title>
 </head>
 <body>
     <div class="container">
        <div class="row justify-content-center">

        <form action="" method="post" class="form-group text-center p-5">

            <h3 class="mb-5">🧹 Porszívó webshop ~ Regisztráció  🧹</h3>
        
            <span class="text-danger d-block mb-5"><?php    if(!empty($error)){echo $error;}    ?></span>
            <span class="text-info d-block mb-5"><?php      if(!empty($success)){echo $success;}    ?></span>

            <label for="">Felhasználónév</label>
            <input type="text" name="user" class="form-control mb-5" value="<?php echo (isset($user) ? $user : ''); ?>">

            <label for="">E-mail cím</label>
            <input type="text" name="email" class="form-control mb-5" value="<?php echo (isset($email) ? $email : ''); ?>">

            <label for="">Jelszó</label>
            <input type="password" name="pwd" class="form-control mb-5">

             <button type="submit" name="reg" class="btn btn-outline-secondary mb-5">Regisztráció</button>
            <br>
             <a href="login.php">Van már fiókod? Lépj be!</a>


        </form>


        </div>


     </div>
 
 
 </body>
 </html>