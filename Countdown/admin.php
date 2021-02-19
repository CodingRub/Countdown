<?php 
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'edit.php'; 
include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <script rel="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Countdown - Admin</title>
</head>
<body>
    <div class="adminarea">
            <div class="logout">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
                <a href="countdown.php"><i class="fas fa-hourglass-half"></i></a>
            </div>
            <div class="users">
                <table id="customers">
                <h2>Liste des utilisateurs: </h2>
                <div class="add" style="display: none;">
                    <button>Promove</button>
                </div>
                    <tr>
                        <th>User</th>
                        <th>Date</th>
                        <th>Email</th>
                        <th>Connecté ?</th>
                        <th>Action</th>
                    </tr>
                    <?php $reponse = $bdd->query('SELECT pseudo, email, statut, connected, id, DATE_FORMAT(created, "%d/%m/%Y") AS created FROM member ORDER BY ID ASC');
                    // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                    while ($donnees = $reponse->fetch()){

                        if($donnees['connected'] == "true") {
                            echo '<tr><td class="withStat"><div class="all"><span>' . htmlspecialchars($donnees['pseudo']) . '</span><span>'. htmlspecialchars($donnees['statut']) .'</span></div></td><td>' . htmlspecialchars($donnees['created']) . '</td><td>' . htmlspecialchars($donnees['email']) . '</td><td style="color:lightgreen;"><i class="fas fa-circle"></i></td><td><a href="#" class="editIcon"><i class="fas fa-user-edit"></i></a> <a href="suprimerUser.php?id='. htmlspecialchars($donnees['id']).'"><i class="fas fa-trash-alt"></i></a></td>';
                            echo '<tr class="editSave"><form method="post"><td class="withStat"><div class="all"><input id="prodId" name="prodId" type="hidden" value="'. htmlspecialchars($donnees['id']) .'"><span><input class="newName"  name="newPseudo" placeholder="Nouveau pseudo:" type="text"></span><span><select class="Rank" name="rank"><option value="user">User</option><option value="modo">Modérateur</option><option value="admin">Admin</option></select></span></div></td><td>15/11/2021</td><td><input class="newMail" type="text" name="newMail"></td><td style="color:lightgreen;"><i class="fas fa-circle"></i></td><td><input type="submit" name="save" value="Save"></td></form></tr>';
                        } else {
                            echo '<tr><td class="withStat"><div class="all"><span>' . htmlspecialchars($donnees['pseudo']) . '</span><span>'. htmlspecialchars($donnees['statut']) .'</span></div></td><td>' . htmlspecialchars($donnees['created']) . '</td><td>' . htmlspecialchars($donnees['email']) . '</td><td style="color:red;"><i class="fas fa-circle"></i></td><td><a href="#" class="editIcon"><i class="fas fa-user-edit"></i></a> <a href="suprimerUser.php?id='. htmlspecialchars($donnees['id']).'"><i class="fas fa-trash-alt"></i></a></td>';
                            echo '<tr class="editSave"><form method="post"><td class="withStat"><div class="all"><input id="prodId" name="prodId" type="hidden" value="'. htmlspecialchars($donnees['id']) .'"><span><input class="newName"  name="newPseudo" placeholder="Nouveau pseudo:" type="text"></span><span><select class="Rank" name="rank"><option value="user">User</option><option value="modo">Modérateur</option><option value="admin">Admin</option></select></span></div></td><td>15/11/2021</td><td><input class="newMail" type="text" name="newMail"></td><td style="color:red;"><i class="fas fa-circle"></i></td><td><input type="submit" name="save" value="Save"></td></form></tr>';
                        }
                    }
                    $reponse->closeCursor();
                    ?>
                <?php
                    if(isset($info)) {
                        echo '<font color="red">'.$info."</font>";
                    }
                ?>
                </table>
            </div>
    </div>
    <script src="js/edit.js"></script>
</body>
</html>
