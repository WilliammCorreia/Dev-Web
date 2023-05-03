<?php require_once("functions.php"); 

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

if (!isset($_SESSION['perso'])) {
    header('Location: persos.php');
}

?>
<?php require_once("_header.php"); ?>
<div class="index">
    <h1>Votre personnage est mort !</h1>
    <h3>Il a perdu tout son XP et ses caractéristiques.</h3>
</div>
    