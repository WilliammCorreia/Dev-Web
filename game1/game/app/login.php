<!-- Pour vérifier que ca envoie bien nos données -->
<?php

    require_once('functions.php');

    if(isset($_POST["send"]))
    {
        $bdd = connect();

        $sql ="SELECT * FROM users WHERE `email` = :email;";

        $sth = $bdd->prepare($sql);

        $sth->execute ([
            'email' => $_POST['email'],
        ]);

        $user = $sth->fetch();

        if ($user && password_verify($_POST['password'], $user['password']) ) {
            //dd($user);
            $_SESSION['user'] = $user;
            header('Location: persos.php');
        } else {
            $msg = "Email ou mot de passe incorrect !";
        }

        //header('Location: login.php');
    }

?>
<?php require_once('_header.php'); ?>
<body>
    <div class="login">
    <form action="" method="post">
        <h1>Connexion</h1>

        <?php if(isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

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
            <input class="btn-blue"type="submit" name="send" value="Se connecter">
        </div>
    </form>
    </div>
</body>
</html>