function charger(){

    setTimeout( function(){
        // on lance une requête AJAX
        $.ajax({
            url : "charger.php",
            type : GET,
            success : function(html){
                $('#messages').prepend(html); // on veut ajouter les nouveaux messages au début du bloc #messages
            }
        });

        charger(); // on relance la fonction

    }, 5000); // on exécute le chargement toutes les 5 secondes

}

charger();
