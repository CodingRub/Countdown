<?php 
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown - Chat</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <script src="js/timer.js"></script>
    <script rel="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="countdown">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        <div class="centered">
            <div class="column">
                <h1>Countdown du Nouvel An:</h1>
                <h3>Il nous reste: </h3>
                <p id="time"></p>
            </div>
        </div>
    </div>
    <div class="chat">
        <p>Chat</p>
        <div class="scroller">
            <?php 
            $response = $bdd->query('SELECT * FROM messages ORDER BY id ASC'); 
            while ($donnees = $response->fetch()) {?>
            <div id="complete" style="padding: 10px;">
                <?php echo "<p>" . $donnees['pseudo'] . " dit : " . $donnees['chat'] . "</p>"; ?>
            </div>
            <?php }
                $response->closeCursor(); // Termine le traitement de la requête
            ?>
        </div>
        <form class="messagearea" name="sendMessage" action="" method="post">
            <textarea placeholder="Votre message: "name="message" id="message" cols="40" rows="2"></textarea>
            <input type="submit" id="send" name="send" placeholder="Login !" value="Envoyer">
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $(".messagearea").on('submit', function(e){
            e.preventDefault();
            var message = $("#message").val();
            var pseudo = "<?php echo $_SESSION['pseudo']; ?>";
            if(message != ""){
                $.ajax({
                    url: "send.php",
                    type: "POST",
                    data: {message: message, pseudo: pseudo},
                    success: function(data) {
                        console.log(data);
                    }
                });
                $('#complete').append("<p>" + pseudo + " dit : " + message + "</p>");
            }
            });
        });
    </script>
</body>
</html>