<?php require_once("functions.php"); 

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

if (!isset($_SESSION['perso'])) {
    header('Location: persos.php');
}

$bdd = connect();
$sql = "UPDATE persos SET `gold` = :gold, `pdv` = :pdv, `for` = :for, `dex` = :dex, `int` = :int, `char` = :char, `vit` = :vit, `level` = :level, `xp` = :xp WHERE id = :id AND user_id = :user_id;";    
$sth = $bdd->prepare($sql);

$sth->execute([
    'gold'      => 0,
    'pdv'       => 20,
    'for'       => 10,
    'dex'       => 10,
    'int'       => 10,
    'char'      => 10,
    'vit'       => 10,
    'level'     => 1,
    'xp'        => 0,
    'id'        => $_SESSION['perso']['id'],
    'user_id'   => $_SESSION['user']['id']
]);

?>
<?php require_once("_header.php"); ?>
<div class="body_mort">
    <h1 class="mort" >vous êtes mort</h1>
    <a class="btn-mort" href="persos.php">Ressusciter</a>
</div>