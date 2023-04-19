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

        if (!isset($_SESSION['fight']))
        {
            $nb = random_int(0,10);

            if($nb <= 8) {
                $ennemi = new Gobelin();
            } else {
                $ennemi = new DarkKnight();
            }

            $_SESSION['fight']['ennemi'] = $ennemi;
            $_SESSION['fight']['html'] = "Vous tombez sur un ". $ennemi->name ." !";
        }

        if( $_SESSION['fight']['ennemi']->speed > $_SESSION['perso']['vit']) 
        {
            $_SESSION['fight']['html'][] = $ennemi->name . 'taper en premier';
        }
        else
        {
            $_SESSION['fight']['ennemi']
        }

        require_once('_header.php');

?>
    <div class="container">
        <div class="row mt-4">
            <div class="px-4">

            </div>
        </div>
    </div>

        <?php
            foreach($_SESSION['fight']['html'] as $html) {
                echo '<p>'.$html.'</p>';
            }
        ?>
        <a class="btn-green" href="donjon_fight.php?id=<?php echo $_GET['id']; ?>">
            Attaquer
        </a>
        <a class="btn-blue" href="donjon_play.php?id=<?php echo $_GET['id']; ?>">
            Fuir
        </a>
    </body>
</html>