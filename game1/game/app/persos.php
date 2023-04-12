<?php require_once('functions.php');

    // Vérifie que l'utilisateur est connecté, s'il n'est pas connecté, il l'envoie vers "login.php"
    if (!isset($_SESSION['user'])) 
    {
        header('Location: login.php');
    }

    // Envoie la valeur de la fonction connect() dans la variale $bdd
    $bdd = connect();

    $sql = "SELECT * FROM persos WHERE user_id = :user_id";
    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'user_id'       => $_SESSION['user']['id']
    ]);

    $persos = $sth->fetchAll();

    //dd($persos);

?>
    <?php require_once('_header.php'); ?>

    <div class="container">
            <h1>Vos personnages</h1>
            <a href="persos_add.php">Créer un personnage</a>

            <?php if (isset($_GET['msg'])) {
                echo "<div>" . $_GET['msg']. "</div>";
            } ?>

            <table>
                <thead>
                    <tr>
                        <td width="2%">ID</td>
                        <td>Nom</td>
                        <td width="30%">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($persos as $perso) { ?>
                        <tr>
                            <td><?php echo $perso['id']; ?></td>
                            <td><?php echo $perso['name']; ?></td>
                            <td>
                                <a 
                                    class="btn-grey" 
                                    href="persos_choice.php?id=<?php echo $perso['id'];?>"
                                    >Choisir
                                </a>
                            </td>
                            <td>
                                <a 
                                    class="btn-grey" 
                                    href="persos_show.php?id=<?php echo $perso['id'];?>"
                                    >Afficher
                                </a>
                            </td>
                            <td>
                                <a class="btn-blue" 
                                    href="persos_maj.php?id=<?php echo $perso['id'];?>"
                                    >Modifier
                                </a>
                            </td>
                            <td>
                                <a 
                                    class="btn-red" 
                                    href="persos_del.php?id=<?php echo $perso['id'];?> 
                                    onClick="return confirm('Voulez-vous vraiment le supprimer ?')"
                                    >Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>    
            </table>
        </body>
        </html>
    </div>
    