<?php require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_GET['id'])) {
        header('Location: persos.php?msg=id non passé !');
    }

    $bdd = connect();

    $sql="SELECT * FROM persos WHERE id = :id AND user_id=:user_id;";

    $sth = $bdd->prepare($sql);

    $sth->execute([
        'id'        => $_GET['id'],
        'user_id'   => $_SESSION['user']['id']
    ]);

    // fetch() récupère les données dans $sth et les mets dans $perso
    $perso = $sth->fetch();
?>

    <?php require_once('_header.php'); ?>

    <div class="login">
        <h1>Détails du personnage</h1>

        <b>Nom:</b> <?php echo $perso['name']; ?>

        <a href="persos.php" class="btn">Retour</a>
    </div>
    
</html>
</body>