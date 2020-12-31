function getMessages(){
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "send.php");
    requeteAjax.onload = function() {
        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.map(function(message){
            return `<div id="complete" style="padding: 10px; color: white">
                        <span class="author">${message.pseudo}: </span>
                        <span class="content">${message.chat}</span>
                    </div>`
        }).join('');
        const messages = document.querySelector('.scroller');
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
    }
    requeteAjax.send();
}

function postMessage(event){
    event.preventDefault();
    const content = document.querySelector("#message");
    const data = new FormData();
    data.append('message', content.value);
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("POST", 'send.php?task=write');
    requeteAjax.onload = function(){
        content.value = "";
        content.focus();
        getMessages();
    }
    requeteAjax.send(data)

}
document.querySelector('form').addEventListener('submit', postMessage);
const interval = window.setInterval(getMessages, 2000);
