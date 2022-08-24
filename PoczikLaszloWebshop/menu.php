

<nav>
    <a href="index.php">Főoldal</a>
    <a href="termekek.php">Termékek</a>
    <a href="kereses.php">Keresés</a>
    <a href="kosar.php">Kosár</a>
    <a href="tajekoztato.php">Vásárlói tájékoztató</a>
    <a href="kapcsolat.php">Kapcsolat</a>
    <div class="float-right">
        <?php if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){ ?>
            <a href="user.php"><i class="fas fa-user mr-3"></i><?php    echo $_SESSION["user"]; ?></a>
            <form action="login.php" method="GET" style="display:inline;">
                <button type="submit" name="logout"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        <?php } else { ?>
            <a href="login.php"><i class="fas fa-user"></i></a>
        <?php } ?>
    </div>
</nav>



