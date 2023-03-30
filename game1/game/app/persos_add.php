<?php require_once('functions.php');

    if (!isset($_SESSION['user'])) 
    {
        header('Location: login.php');
    }

    if (isset($_POST["send"])) 
    {
        if ($_POST['name'] != "") 
        {
            $bdd = connect();

            $sql = "INSERT INTO persos (`name`, `for`, `dex`, `int`, `char`, `vit`, `pdv`, `user_id`) VALUES (:name, :for, :dex, :int, :char, :vit, :pdv, :user_id);";
            echo $sql;
            $sth = $bdd->prepare($sql);

            $sth->execute ([
            'name'     => $_POST['name'],
            'for'      => 10,
            'dex'      => 10,
            'int'      => 10,
            'char'     => 10,
            'vit'      => 10,
            'pdv'      => 20,
            'user_id'  => $_SESSION['user']['id']
            ]);

            header('Location: persos.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once('nav.php'); ?>
    <h1>Créer un personnage</h1>
    <form action="" method="post">
        <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="Entrez un nom" required>
        </div>
        <div>
            <input type="submit" name="send" value="Créer">
        </div>
    </form>
</body>
</html>