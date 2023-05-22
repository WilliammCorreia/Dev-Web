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

    $sql = "SELECT * FROM persos";
        
    $sth = $bdd->prepare($sql);
    
    $sth->execute();
    
    $donjons = $sth->fetchAll();
?>

<?php require_once("_header.php"); ?>


<section class="login">
    
    <header>
        <h1>Bienvenue dans le Marché Noir</h1>
        <h3>Vous avez <?php echo $_SESSION['perso']['gold']; ?> pièces d'or.</h3>
    </header>
    
    <article>
        <h4>Acheter une potion de vie pour 250 pièces ?</h4>
        <form action="" method="get">
            <div class="form-row">
                <label for="char"></label>
                    <select class="form-field" id="char" name="char">
                        <option value="1">Oui</option>
                        <option value="2">Non</option>
                    </select>
            </div>
            <div class="btn-form">
                <input 
                    type="submit" 
                    class="form-field" 
                    name="send" 
                    value="Confirmer" 
                />
            </div>
        </form>
    </article>
</section>

<?php 
    $valeur = 0;

    if (isset($_GET['send'])) {
        $valeur = $_GET['char'];
    }

    // Incrémentation des valeurs
    if ( $valeur == 1 )
    {
        $_SESSION['perso']['pdv'] = (15+($_SESSION['perso']['level']*5));
        $_SESSION['perso']['gold'] -= 250;
        header("Location: donjons.php");
    }
    else if ( $valeur == 2 )
    {
        header("Location: donjons.php");
    }

    // Sauvegarde de l'état de votre personnage
    $bdd = connect();
    $sql = "UPDATE persos SET `pdv` = :pdv, `gold` = :gold WHERE id = :id AND user_id = :user_id;";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'pdv'       => $_SESSION['perso']['pdv'],
        'gold'       => $_SESSION['perso']['gold'],
        'id'        => $_SESSION['perso']['id'],
        'user_id'   => $_SESSION['user']['id']
    ]);