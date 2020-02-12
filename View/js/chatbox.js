$(document).ready(() => {
    let infos = [];
    infos ['id'] = 1; //Il faudra dans le futur récupérer l'id de l'utilisateur connecté via les cookies
    infos ['idConv'] = -1;
    infos ['curPseudo'] = "";

    const chat = $("#chatbox");

    chat.click(openChat);

    function openChat() {
        chat.off("click");
        chat.removeClass("closed");

        if (infos ['idConv'] === -1) {
            $("#chatbox-header").html("<h1>Preclarity Chat</h1>" +
                "<img src='http://img.icons8.com/metro/26/000000/cancel.png' alt='réduire' class='chatbox-btn' id='reduce-chatbox'>");
            $("#chatbox-footer").empty();
            showConvs();
        } else {
            openConv(infos ['idConv']);
        }

        chat.animate({height: "50vh"}, "slow");
        $("#reduce-chatbox").click(closeChat);
    }

    function closeChat() {
        $("#chatbox-header").html("<h1>Preclarity Chat</h1>");
        chat.height("6vh");
        chat.addClass("closed");

        setTimeout(() => {
            chat.click(openChat);
        }, 1);
    }

    function showConvs() {
        const box = $("#chatbox-box");

        $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getConversations&id=" + infos ['id'],
            async function (convs) {

            let content = "<ul id='chatbox-convs'>";
            let ids = [];
            let pseudos = [];
            for (let i = 0; i < convs.length; ++i) {
                let idPerson = convs[i]['idUser1'] === infos ['id'].toString() ? convs[i]['idUser2'] : convs[i]['idUser1'];

                await $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getUser&id=" + idPerson,
                    (person) => {
                    let curId = convs[i]['id'];
                    ids.push(curId);
                    pseudos.push(person['pseudo']);
                    content += "<li id='p" + curId + "'>" +
                        "<img class='pp' src='" + person['imageProfil'] + "' alt='profile picture'>" +
                        person['pseudo'] +
                        "</li>";
                });
            }
            content += "</ul>";
            box.html(content);
            for (let i = 0; i < ids.length; ++i)
                $("#p" + ids[i]).click(() => {
                    openConv(ids[i], pseudos[i]);
                });
        });
    }

    function openConv (id) {
        const header = $("#chatbox-header");
        const footer = $("#chatbox-footer");

        infos ['idConv'] = id;

        $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getConversation&id=" + id,
            (conv) => {

            let idPerson = conv ['idUser1'] === infos ['id'].toString() ? conv ['idUser2'] : conv ['idUser1'];
            $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getUser&id=" + idPerson,
                (person) => {

                header.html(
                    '<img src="http://img.icons8.com/android/24/000000/circled-left-2.png" alt="retour" class="chatbox-btn" id="back-to-list">'
                    + "<h1>"  + person['pseudo'] + "</h1>" +
                    '<img src="http://img.icons8.com/metro/26/000000/cancel.png" alt="réduire" class="chatbox-btn" id="reduce-chatbox">');

                $("#reduce-chatbox").click(closeChat);
                $("#back-to-list").click(backToList);
                refreshMessages();
            });
        });

        footer.html(
            "<input type='text' placeholder='Entrez votre message ici ...' id='input-msg'>" +
            "<img id='chatbox-send' src='http://img.icons8.com/ios-glyphs/30/000000/paper-plane.png' alt='envoyer' class='chatbox-btn'>");

        $('#input-msg').on('keypress',(e) => {
            if(e.which === 13) {
                sendMessage();
            }
        });
        $("#chatbox-send").click(sendMessage);
    }

    function sendMessage() {
        let input = $("#input-msg");
        let msg = input.val();
        $.ajax("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=sendMessage&idUser=" + infos ['id'] +
            "&idConv=" + infos['idConv'] +
            "&msg=" + msg);
        input.val("");
    }

    let nbMessages = -1;
    function refreshMessages() {
        const box = $("#chatbox-box");
        if (infos ['idConv'] !== -1) {
            $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getMessages&id=" + infos ['idConv'],
                (messages) => {
                    if (nbMessages < messages.length) {
                        nbMessages = messages.length;
                        box.empty();
                        for (let i = 0; i < messages.length; ++i) {
                            if (messages[i]['idAuteur'] !== infos['id'].toString())
                                box.append("<div class='chat-msg'>" + messages[i]['content'] + "</div>");
                            else
                                box.append("<div class='chat-msg user'>" + messages[i]['content'] + "</div>");
                            box.scrollTop(box[0].scrollHeight);
                        }
                    }
                });
            setTimeout(refreshMessages, 500);
        }
    }

    function backToList() {
        infos ['idConv'] = -1;
        openChat();
    }
});