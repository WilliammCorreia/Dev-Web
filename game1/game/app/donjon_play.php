<?php
    require_once('functions.php');

        // Vérifie que l'utilisateur est connecté, s'il n'est pas connecté, il l'envoie vers "login.php"
        if (!isset($_SESSION['user'])) 
        {
            header('Location: login.php');
        }

        // Vérifie que l'utilisateur à choisi un personnage 
        if (!isset($_SESSION['perso'])) 
        {
            header('Location: persos.php');
        }

        // A chaque fois que l'on revient sur notre session, ca nous enlève le fight 
        if (isset($_SESSION['fight']))
        {
            unset($_SESSION['fight']);
        }

        $bdd = connect();
        
        $sql = "SELECT * FROM `rooms` WHERE donjon_id = :donjon_id ORDER BY RAND() LIMIT 1;";

        $sth = $bdd->prepare($sql);
    
        $sth->execute([
            'donjon_id'     => $_GET['id']
        ]);

        // On utilise fetchAll quand on veut recuperer une liste d'élément, et fetch quand on veut un élément
        $room = $sth->fetch();

        require_once('./classe/Room.php');
        $roomObject = new Room($room);

        // $roomObject->name = "toto";
?>

<?php require_once('_header.php') ?>
    <div class="container">
        <div class="row">
            <div>
                <?php require_once('_perso.php'); ?>
            </div>
            <div class="">
                <h1><?php echo $roomObject->getName(); ?></h1>
                <p><?php echo $roomObject->getDescription(); ?></p>
                <?php echo $roomObject->getActions(); ?>
            </div>
        </div>
    </div>
    </body>
</html>