<?php
    require_once('functions.php');

        // Vérifie que l'utilisateur est connecté, s'il n'est pas connecté, il l'envoie vers "login.php"
        if (!isset($_SESSION['user'])) 
        {
            header('Location: login.php');
        }

        // Vérifie que l'utilisateur à choisi un personnage 
        if (!isset($_SESSION['perso'])) 
        {
            header('Location: persos.php');
        }
    
        // Envoie la valeur de la fonction connect() dans la variale $bdd
        $bdd = connect();
    
        $sql = "SELECT * FROM donjons";
        
        $sth = $bdd->prepare($sql);
    
        $sth->execute();
    
        $donjons = $sth->fetchAll();
?>

<?php require_once('_header.php'); ?>

    <div class="login">

        <section class="donjons">
            <h1><?php echo $_SESSION['perso']['name']; ?></h1>
            <h6> <a href="persos.php" class="btn-change">(Changer de personnage)</a> </h6>
        </section>

        <main>
            <ul>
                <?php foreach($donjons as $donjon) { ?>
                <li>
                    <a href="donjon_play.php?id=<?php echo $donjon['id'];?>" class="btn-mort">
                    <?php echo $donjon['name']; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </main>

    </div>

</body>
</html>