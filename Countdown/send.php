<?php 
include 'connection.php';
$message = false;
$pseudo = false;
if(isset($_POST['message']) AND isset($_POST['pseudo'])){
    $message = $_POST['message'];
    $pseudo = $_POST['pseudo'];
    $req = $bdd->prepare('INSERT INTO messages(pseudo, chat) VALUES(:pseudo, :chat)');
    $req->execute(array(
        'pseudo' => $pseudo,
        'chat' => $message));
    echo 'Received message was ' . $message. ' by ' . $pseudo;
}
?>