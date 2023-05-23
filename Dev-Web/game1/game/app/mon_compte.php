<?php
require_once('functions.php');

// Vérifie que l'utilisateur est connecté, s'il n'est pas connecté, il l'envoie vers "login.php"
if (!isset($_SESSION['user'])) 
{
    header('Location: login.php');
    exit(); // Ajout de la sortie après la redirection pour arrêter l'exécution du script
}

// Envoie la valeur de la fonction connect() dans la variable $bdd
$bdd = connect();

// Affichage de l'email actuel
$email = "";

$sql = "SELECT email FROM users";

$sth = $bdd->prepare($sql);

$sth->execute();

$email = $sth->fetchColumn();

?>

<?php require_once('_header.php'); ?>

<article class="login">

    <h2>Modification d'email</h2><br>
    <form method="POST" action="">
        <label for="new_email">Nouvel email :</label>
        <input type="email" name="new_email" required><br><br>
        <input type="submit" value="Modifier">
    </form>

</article>

<?php
// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newEmail = $_POST["new_email"];

    $sql = "UPDATE users SET `email` = :email WHERE id = :id";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'email' => $newEmail,
        'id' => $_SESSION['user']['id'],
    ]);
}
?>
</body>
</html>