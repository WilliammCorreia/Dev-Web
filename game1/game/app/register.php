<!-- Pour vérifier que ca envoie bien nos données -->
<?php

    require_once('functions.php');

    if(isset($_POST["send"]))
    {
        $bdd = connect();

        $sql ="INSERT INTO users (`email`, `password`) VALUES (:email, :password);";
        $sth = $bdd->prepare($sql);
        $sth->execute ([
            'email'    => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: login.php');
    }

?>
<?php require_once("_header.php"); ?>
<div class="login">
    <form action="" method="post">
        <h1>Création d'un compte</h1>
        <div class="email_mdp">
            <div>
                <label for="email"></label>
                <!-- id ca sert pour la feuille de style -->
                <input type="email" placeholder="Entrez un email" name="email" id="email">
            </div>
            <div>
                <label for="password"></label>
                <!-- id ca sert pour la feuille de style -->
                <input type="password" placeholder="Entrez un mot de passe" name="password" id="password">
            </div>
            <div>
                <!-- Pour envoyer la requete-->
                <input class="btn-blue" type="submit" name="send" value="Créer">
            </div>
        </div>
    </form>
</div>
</body>
</html>