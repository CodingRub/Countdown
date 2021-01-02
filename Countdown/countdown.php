<?php 
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include "connection.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown - Chat</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <script src="js/timer.js"></script>
    <script rel="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="countdown">
        <div class="arealogout">
            <a class="logout" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
            <?php if($_SESSION['statut'] == "admin"){
                echo '<a class="counter" href="admin.php"><i class="fas fa-users-cog"></i></a>';
            }
            ?>
        </div>
        <div class="centered">
            <div class="column">
                <h1>Countdown du Nouvel An:</h1>
                <h3>Il nous reste: </h3>
                <p id="time"></p>
            </div>
        </div>
        <div class="areaarrow">
            <a class="arrow"><i class="fas fa-arrow-up"></i></a>
        </div>
        <div class="network">
                <ul>
                    <li><a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fcountdownyear.000webhostapp.com%2F&text=Tout+seul+?+Venez+fêter+le+nouvel+an+avec+des+gens&hashtags=nouvelan2021"><i class="fab fa-twitter-square"></i></a></li>
                    <li><i class="fab fa-facebook-square"></i></li>
                    <li><i class="fas fa-envelope-square"></i></li>
                </ul>
        </div>
    </div>
    <div class="chat">
        <p>Chat</p>
        <div class="scroller">
        </div>
        <form class="messagearea" name="sendMessage" action="send.php?task=write" method="post">
            <textarea placeholder="Votre message: "name="message" id="message" cols="40" rows="2"></textarea>
            <div class="color">
                <input type="color" name="color" id="color">
                <input type="submit" id="send" name="send" placeholder="Login !" value="Envoyer">
            </div>
        </form>
    </div>
    <script src="js/ajax.js"></script>
    <script src="js/socialnetwork.js"></script>
</body>
</html>
