<?php 
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <title>Countdown - Admin</title>
</head>
<body>
    <div class="adminarea">
        <div class="arealogout">
            <a class="logout" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
            <a class="counter" href="countdown.php"><i class="fas fa-hourglass-half"></i></a>
        </div>
        <div class="centered">
            <table id="customers">
            <caption>Liste des utilisateurs: </caption>
                <tr>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Connecté ?</th>
                    <th>Action</th>
                </tr>
                <?php $reponse = $bdd->query('SELECT * FROM member ORDER BY ID ASC');
                // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                while ($donnees = $reponse->fetch()){
                    echo '<tr><td>' . htmlspecialchars($donnees['id']) .'</td><td>' . htmlspecialchars($donnees['pseudo']) . '</td><td>' . htmlspecialchars($donnees['email']) . '</td><td>' . htmlspecialchars($donnees['statut']) . '</td><td>' . htmlspecialchars($donnees['connected']) . '</td><td><a href="suprimerUser.php?id='. htmlspecialchars($donnees['id']).'">Suprimer</a></td>';
                }
                $reponse->closeCursor();
                ?>
            </table>
        </div>
    </div>
</body>
</html>