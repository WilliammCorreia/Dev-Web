<?php require_once('functions.php');

    // Vérifie que l'utilisateur est connecté, s'il n'est pas connecté, il l'envoie vers "login.php"
    if (!isset($_SESSION['user'])) 
    {
        header('Location: login.php');
    }

    // Envoie la valeur de la fonction connect() dans la variale $bdd
    $bdd = connect();

    $sql = "SELECT * FROM users WHERE email = :email";
    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'email'       => $_SESSION['email']
    ]);

    $users = $sth->fetchAll();

    //dd($persos);

?>

<?php require_once('_header.php'); ?>

    <h1>
        <?php echo $_SESSION['user']['email']; ?>
    </h1>
    <form action="" method="post">
        <?php foreach ($users as $user) { ?>
        <div>
            <label for="email">Email</label>
            <input 
                type="text" 
                id="email" 
                name="email" 
                placeholder="Entrez un email" 
                value="<?php echo $user['email']; ?>" 
                required
            >
        </div>
        <?php } ?>
        <div>
            <input type="submit" name="send" value="Modifier" class="btn">
        </div>
    </form>
</body>
</html>