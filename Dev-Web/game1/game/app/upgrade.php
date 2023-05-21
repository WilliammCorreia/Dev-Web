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

<main class="login">
    <h3>Améliorer une caractéristique :</h3>

    <form action="" method="get">
        <div class="form-row">
            <label for="char"></label>
                <select class="form-field" id="char" name="char">
                    <option value="1">Force</option>
                    <option value="2">Dextérité</option>
                    <option value="3">Intelligence</option>
                    <option value="4">Charisme</option>
                    <option value="5">Vitesse</option>
                </select>
        </div>
        <div class="btn-form">
            <input 
                type="submit" 
                class="form-field" 
                name="send" 
                value="Améliorer" 
            />
        </div>
    </form>
</main>

 <?php 
    $valeur = 0;

    if (isset($_GET['send'])) {
        $valeur = $_GET['char'];
    }


    // Incrémentation des valeurs
    if ( $valeur == 1 )
    {
        $_SESSION['perso']['for'] += 2;
        header("Location: donjons.php");
    }
    else if ( $valeur == 2 )
    {
        $_SESSION['perso']['dex'] += 2;
        header("Location: donjons.php");
    }
    else if ( $valeur == 3 )
    {
        $_SESSION['perso']['int'] += 2;
        header("Location: donjons.php");
    }
    else if ( $valeur == 4 )
    {
        $_SESSION['perso']['char'] += 2;
        header("Location: donjons.php");
    }
    else if ( $valeur == 5 )
    {
        $_SESSION['perso']['vit'] += 2;
        header("Location: donjons.php");
    }

    // Sauvegarde de l'état de votre personnage
    $bdd = connect();
    $sql = "UPDATE persos SET `for` = :for, `dex` = :dex, `int` = :int, `char` = :char, `vit` = :vit WHERE id = :id AND user_id = :user_id;";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'for'      => $_SESSION['perso']['for'],
        'dex'       => $_SESSION['perso']['dex'],
        'int'       => $_SESSION['perso']['int'],
        'char'       => $_SESSION['perso']['char'],
        'vit'       => $_SESSION['perso']['vit'],
        'id'        => $_SESSION['perso']['id'],
        'user_id'   => $_SESSION['user']['id']
    ]);