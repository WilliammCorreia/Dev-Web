<?php require_once("functions.php"); 

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

if (!isset($_SESSION['perso'])) {
    header('Location: persos.php');
}

$bdd = connect();
$sql = "UPDATE persos SET `gold` = :gold, `pdv` = :pdv WHERE id = :id AND user_id = :user_id;";    
$sth = $bdd->prepare($sql);

$sth->execute([
    'gold'      => 0,
    'pdv'       => 20,
    'id'        => $_SESSION['perso']['id'],
    'user_id'   => $_SESSION['user']['id']
]);

?>
<?php require_once("_header.php"); ?>
<div class="body_mort">
    <h1 class="mort" >vous êtes mort</h1>
    <a class="btn-mort" href="persos.php">Ressusciter</a>
</div>