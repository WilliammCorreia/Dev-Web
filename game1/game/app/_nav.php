<ul id="nav">
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a href="register.php" class="bouton">Créer un compte</a></li>
        <li><a href="login.php" class="bouton">Connexion</a></li>
    <?php } else { ?>
        <li><a href="persos.php"><?php echo $_SESSION['user']['email'] ?></a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="mon_compte.php">Mon compte</a></li>
    <?php } ?>
</ul>