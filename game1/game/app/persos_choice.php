<?php require_once('functions.php');

    // Vérifie que l'utilisateur est connecté, s'il n'est pas connecté, il l'envoie vers "login.php"
    if (!isset($_SESSION['user'])) 
    {
        header('Location: login.php');
    }

    // Envoie la valeur de la fonction connect() dans la variale $bdd
    $bdd = connect();

    $sql = "SELECT * FROM persos WHERE id= :id AND user_id = :user_id";
    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'id'            => $_GET['id'],
        'user_id'       => $_SESSION['user']['id']
    ]);

    // On met seulement "fetch" et pas "fetchAll", car on veut en récupérer qu'un seul
    $perso = $sth->fetch();

    $_SESSION['perso'] = $perso;

    header('Location: donjons.php');

    //dd($perso);

?>