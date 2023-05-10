<? require_once("_header.php"); ?>

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
    <div class="form-row">
        <input 
            type="submit" 
            class="form-field" 
            name="send" 
            value="Améliorer" 
        />
    </div>
 </form>

 <?php 
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }

    if (isset($_GET['send'])) {
        $valeur = $_GET['char'];
    }

    // Incrémentation des valeurs
    if ( $valeur == 1 )
    {
        $_SESSION['perso']['for'] += 2;
    }
    else if ( $valeur == 2 )
    {
        $_SESSION['perso']['dex'] += 2;
    }
    else if ( $valeur == 3 )
    {
        $_SESSION['perso']['int'] += 2;
    }
    else if ( $valeur == 4 )
    {
        $_SESSION['perso']['char'] += 2;
    }
    else if ( $valeur == 5 )
    {
        $_SESSION['perso']['vit'] += 2;
    }
    else
    {
        echo "Tricheur";
    }

    // Amélioration des points de vie
    $_SESSION['perso']['pdv'] += 5;