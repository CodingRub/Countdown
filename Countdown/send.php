<?php 
session_start();
include "connection.php";
$task = "list";
$author = $_SESSION['pseudo'];


if(array_key_exists("task", $_GET)) {
    $task = $_GET['task'];
}

if($task == "write"){
    postMessage();
} else {
    getMessage();
}

function getMessage(){
    global $bdd;
    $response = $bdd->query('SELECT * FROM messages ORDER BY id ASC'); 
    $messages = $response->fetchAll();
    echo json_encode($messages);
}

function postMessage() {
    global $author;
    global $bdd;

    if(!array_key_exists('message', $_POST)){
        echo json_encode(["status" => "error", "message" => "Le champs du message est vide !"]);
        return;
    } else {
        $content = $_POST['message'];
        $color = $_POST['color'];
        $query = $bdd->prepare('INSERT INTO messages SET pseudo = :pseudo, chat = :chat, color = :color');
        $query->execute(["pseudo" => $author, "chat" => $content, "color" => $color]);
        echo json_encode(["status" => "success", "message" => "Le message est bien pris en compte !"]);
    }
}
?>
