<!-- Pour vérifier que ca envoie bien nos données -->
<?php

    require_once('functions.php');

    if(isset($_POST["send"]))
    {
        $bdd = connect();

        $sql ="INSERT INTO users (`email`, `password`) VALUES (:email, :password);";
        $sth = $bdd->prepare($sql);
        $sth->execute ([
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: login.php');
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
    <form action="" method="post">
        <h1>Création d'un compte</h1>
        <div>
            <label for="email">Email</label>
            <!-- id ca sert pour la feuille de style -->
            <input type="email" placeholder="Entrez un email" name="email" id="email">
        </div>
        <div>
            <label for="password">Mot de Passe</label>
            <!-- id ca sert pour la feuille de style -->
            <input type="password" placeholder="Entrez un mot de passe" name="password" id="password">
        </div>
        <div>
            <!-- Pour envoyer la requete-->
            <input type="submit" name="send" value="Créer">
        </div>
    </form>
</body>
</html>