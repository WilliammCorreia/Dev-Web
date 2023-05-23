<?php

    require_once("functions.php");

    // Pour que les personnes non connecté ne puisse pas avoir accès à la page de modif
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_GET['id'])) {
        header('Location: persos.php?msg=id non passé !');
    }

    $bdd = connect();

    if (isset($_POST["send"])) 
    {
        if ($_POST['name'] != "") 
        {
            $sql = "UPDATE persos SET `name` = :name WHERE id=:id AND user_id = :user_id;";
            
            $sth = $bdd->prepare($sql);

            $sth->execute ([
            'name'     => $_POST['name'],
            'id'       => $_GET['id'],
            'user_id'  => $_SESSION['user']['id']
            ]);

            header('Location: persos.php');
        }
    }

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
        <h1>Modifier un personnage</h1>
        <form action="" method="post">
            <div>
                <label for="name"></label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Entrez un nom" 
                    value="<?php echo $perso['name']; ?>" 
                    required
                >
            </div>
            <div>
                <input type="submit" name="send" value="Modifier" class="btn">
            </div>
        </form>
    </div>

</body>
</html>