<?php

    require_once('./classe/Gobelin.php');
    require_once('./classe/DarkKnight.php');

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }

    // On créé un combat s'il n'y en a pas encore
    if (!isset($_SESSION['fight']))
    {
        $nb = random_int(0,10);

        if ($nb <= 8) {
            $ennemi = new Gobelin();
        } else {
            $ennemi = new DarkKnight();
        }

        $_SESSION['fight']['ennemi'] = $ennemi;
        $_SESSION['fight']['html'][] = "Vous tomber sur un " . $ennemi->name . '.';
    }

    // dd($_SESSION['fight']);
    // On gere le tour de combat.
    // L'ennemi tape en premier
    if ($_SESSION['fight']['ennemi']->speed > $_SESSION['perso']['vit']) {
        $_SESSION['fight']['html'][] = $ennemi->name . ' tape en premier';
        
        $touche = random_int(0, 20);
        $_SESSION['fight']['html'][] = $touche;

        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Il vous touche.";
            $degat = random_int(0, $_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
            $_SESSION['fight']['html'][] = "Il vous inflige " . $degat - floor($_SESSION['perso']['for']/3) . " dégats";
            $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
        } else {
            $_SESSION['fight']['html'][] = "Il vous rate.";
        }

        if ($_SESSION['perso']['pdv'] <= 0) {
            $_SESSION['fight']['html'][] = "Vous etes mort.";
        } else {
            $_SESSION['fight']['html'][] = "Vous attaquez";

            $touche = random_int(0, 20);
            $_SESSION['fight']['html'][] = $touche;

            if ($touche >= 10) {
                $_SESSION['fight']['html'][] = "Vous touchez votre ennmi.";
                $degat = random_int(0,10) + floor($_SESSION['perso']['for']/3);
                
                $_SESSION['fight']['html'][] = "Vous lui infligez " . $degat - floor($_SESSION['fight']['ennemi']->constitution/3) . " dégats";
                $_SESSION['fight']['ennemi']->pol -=  $degat - floor($_SESSION['fight']['ennemi']->constitution/3);

                if ($_SESSION['fight']['ennemi']->pol <= 0) {
                    $_SESSION['perso']['gold'] += $_SESSION['fight']['ennemi']->gold;
                    $_SESSION['perso']['xp'] += $_SESSION['fight']['ennemi']->xp;
                    $_SESSION['fight']['html'][] = "Vous gagnez " . $_SESSION['fight']['ennemi']->gold . " Or et " . $_SESSION['fight']['ennemi']->xp . " XP.";
                    $_SESSION['fight']['html'][] = "Vous avez tuez votre ennemi.";
                    if( $_SESSION['perso']['xp'] >= ($_SESSION['perso']['level'] * 2) )
                    {
                        $_SESSION['perso']['level'] += 1;
                        $_SESSION['perso']['xp'] = 0;
                        $_SESSION['perso']['pdv'] += 5;
                        header("Location: upgrade.php");
                    }
                }
            } else {
                $_SESSION['fight']['html'][] = "Vous ratez votre ennemi.";
            }
        }

    } else {
        $_SESSION['fight']['html'][] = $_SESSION['perso']['name'] . ' tape en premier';
    
        $touche = random_int(0, 20);
        $_SESSION['fight']['html'][] = $touche;

        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Vous touchez votre ennmi.";
            $degat = random_int(0,10) + floor($_SESSION['perso']['for']/3);
            $_SESSION['fight']['html'][] = "Il vous inflige " . $degat - floor($_SESSION['fight']['ennemi']->constitution/3) . " dégats";
            $_SESSION['fight']['ennemi']->pol -=  $degat - floor($_SESSION['fight']['ennemi']->constitution/3);

            if ($_SESSION['fight']['ennemi']->pol <= 0) {
                $_SESSION['perso']['gold'] += $_SESSION['fight']['ennemi']->gold;
                $_SESSION['perso']['xp'] += $_SESSION['fight']['ennemi']->xp;
                $_SESSION['fight']['html'][] = "Vous gagnez " . $_SESSION['fight']['ennemi']->gold . " Or et " . $_SESSION['fight']['ennemi']->xp . " XP.";
                $_SESSION['fight']['html'][] = "Vous avez tuez votre ennemi.";

                if( $_SESSION['perso']['xp'] >= ($_SESSION['perso']['level'] * 2) )
                    {
                        $_SESSION['perso']['level'] += 1;
                        $_SESSION['perso']['xp'] = 0;
                        $_SESSION['perso']['pdv'] += 5;
                        header("Location: upgrade.php");
                    }
            } else {
                $_SESSION['fight']['html'][] = "Votre ennemi attaque";
                $touche = random_int(0, 20);
                $_SESSION['fight']['html'][] = $touche;

                if ($touche >= 10) {
                    $_SESSION['fight']['html'][] = "Il vous touche.";
                    $degat = random_int(0,$_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
                    $_SESSION['fight']['html'][] = "Il vous inflige " . $degat - floor($_SESSION['perso']['for']/3) . " dégats";
                    $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
                } else {
                    $_SESSION['fight']['html'][] = "Il vous rate votre ennmi.";
                }
            }
        } else {
            $_SESSION['fight']['html'][] = "Vous ratez votre ennmi.";

            // Attaque de l'ennemi
            $_SESSION['fight']['html'][] = "Votre ennemi attaque";
            $touche = random_int(0, 20);
            $_SESSION['fight']['html'][] = $touche;

            if ($touche >= 10) {
                $_SESSION['fight']['html'][] = "Il vous touche.";
                $degat = random_int(0,$_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
                $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for']/3)) . " dégats";
                $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
            
                if ($_SESSION['perso']['pdv'] <= 0) {
                    $_SESSION['fight']['html'][] = "Vous etes mort.";
                }
            } else {
                $_SESSION['fight']['html'][] = "Il vous rate votre ennmi.";
            }
        }
    }

    // Sauvegarde de l'état de votre personnage
    $bdd = connect();
    $sql = "UPDATE persos SET `gold` = :gold, `pdv` = :pdv, `xp` = :xp, `level` = :level WHERE id = :id AND user_id = :user_id;";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'gold'      => $_SESSION['perso']['gold'],
        'pdv'       => $_SESSION['perso']['pdv'],
        'xp'       => $_SESSION['perso']['xp'],
        'level'       => $_SESSION['perso']['level'],
        'id'        => $_SESSION['perso']['id'],
        'user_id'   => $_SESSION['user']['id']
    ]);

    // dd($_SESSION);

    if ($_SESSION['perso']['pdv'] <= 0) {
        // unset($_SESSION['perso']);
        unset($_SESSION['fight']);
        header('Location: persos_dead.php');
    }

    require_once('_header.php');
?>
    <div class="container">
        <div class="row mt-4">
            <div class="px-4">
                <?php require_once('_perso.php'); ?>
            </div>
            <div class="">
                <h1>Combat</h1>
                <?php

                    foreach($_SESSION['fight']['html'] as $html) {
                        echo '<p>'.$html.'</p>';
                    }

                ?>

                <?php if ($_SESSION['fight']['ennemi']->pol > 0) { ?>
                    <a class="btn btn-green" href="donjon_fight.php?id=<?php echo $_GET['id']; ?>">
                        Attaquer
                    </a>
                    <a class="btn btn-blue" href="donjon_play.php?id=<?php echo $_GET['id']; ?>">
                        Fuir
                    </a>
                <?php } else { ?>
                    <a class="btn btn-green" href="donjon_play.php?id=<?php echo $_GET['id']; ?>">
                        Continuer l'exploration
                    </a>
                <?php } ?>
            </div>
            <div class="px-4">
                <?php require_once('_ennemi.php'); ?>
            </div>
        </div>
    </div>
    </body>
</html>