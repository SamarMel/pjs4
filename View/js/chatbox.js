$(document).ready(() => {
    let infos = [];

    function getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }

    infos ['id'] = getCookie("idUser"); //Il faudra dans le futur récupérer l'id de l'utilisateur connecté via les cookies
    infos ['idConv'] = -1;
    infos ['curPseudo'] = "";
    infos ['botQuestion'] = -1;

    let nbMessages = -1;

    const chat = $("#chatbox");
    const box = $("#chatbox-box");
    const header = $("#chatbox-header");
    const footer = $("#chatbox-footer");
    chat.click(openChat);

    function openChat() {
        chat.off("click");
        chat.removeClass("closed");

        if (infos ['idConv'] === -1) {
            header.html("<h1>Preclarity Chat</h1>" +
                "<img src='http://img.icons8.com/metro/26/000000/cancel.png' alt='réduire' class='chatbox-btn' id='reduce-chatbox'>");
            footer.empty();
            showConvs();
        } else {
            openConv(infos ['idConv']);
        }

        chat.addClass("opened");
        $("#reduce-chatbox").click(closeChat);
    }

    function closeChat() {
        header.html("<h1>Preclarity Chat</h1>");
        chat.addClass("closed");
        chat.removeClass("opened");
        box.empty();
        footer.empty();

        setTimeout(() => {
            chat.click(openChat);
        }, 1);
    }

    function showConvs() {
        $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getConversations&id=" + infos ['id'],
            async function (convs) {

            let content = "<ul id='chatbox-convs'>";
            content += "<li id='chatbox-bot'>" +
                "<img class='pp' src='https://cdn.dribbble.com/users/37530/screenshots/2937858/drib_blink_bot.gif' alt='bot'>" +
                "Preclaribot" +
                "</li>"
                ;
            let ids = [];
            for (let i = 0; i < convs.length; ++i) {
                let idPerson = convs[i]['idUser1'] === infos ['id'].toString() ? convs[i]['idUser2'] : convs[i]['idUser1'];

                await $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getUser&id=" + idPerson,
                    (person) => {
                    let curId = convs[i]['id'];
                    ids.push(curId);
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
                    openConv(ids[i]);
                });
            $("#chatbox-bot").click(() => {
                openConv(-10);
            })
        });
    }

    function openConv (id) {
        infos ['idConv'] = id;

        if (id === -10) {
            header.html(
                '<img src="http://img.icons8.com/android/24/000000/circled-left-2.png" alt="retour" class="chatbox-btn" id="back-to-list">'
                + "<h1> Preclaribot </h1>" +
                '<img src="http://img.icons8.com/metro/26/000000/cancel.png" alt="réduire" class="chatbox-btn" id="reduce-chatbox">');

            $("#reduce-chatbox").click(closeChat);
            $("#back-to-list").click(backToList);
            loadBot(infos['botQuestion']);
        } else {
            $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getConversation&id=" + id,
                (conv) => {

                    let idPerson = conv ['idUser1'] === infos ['id'].toString() ? conv ['idUser2'] : conv ['idUser1'];
                    $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getUser&id=" + idPerson,
                        (person) => {

                            header.html(
                                '<img src="http://img.icons8.com/android/24/000000/circled-left-2.png" alt="retour" class="chatbox-btn" id="back-to-list">' +
                                "<h1>" +
                                    person['pseudo'] + " " +
                                    "<img src=\"https://img.icons8.com/material-outlined/24/000000/flag.png\" alt='signaler' class='chatbox-btn' id='signal-user'>" +
                                "</h1>" +
                                '<img src="http://img.icons8.com/metro/26/000000/cancel.png" alt="réduire" class="chatbox-btn" id="reduce-chatbox">');

                            $("#reduce-chatbox").click(closeChat);
                            $("#back-to-list").click(backToList);
                            $("#signal-user").click(() => {
                                if (confirm("Voulez-vous vraiment signaler cet utilisateur ?"))
                                    alert ("Pour l'instant ça marche pas mdr");
                            });
                            nbMessages = -1;
                            refreshMessages();
                        });
                });

            footer.html(
                "<input type='text' placeholder='Entrez votre message ici ...' id='input-msg'>" +
                "<img id='chatbox-send' src='http://img.icons8.com/ios-glyphs/30/000000/paper-plane.png' alt='envoyer' class='chatbox-btn'>");

            $('#input-msg').on('keypress', (e) => {
                if (e.which === 13) {
                    sendMessage();
                }
            });
            $("#chatbox-send").click(sendMessage);
        }
    }

    function sendMessage() {
        let input = $("#input-msg");
        let msg = input.val();
        if (msg.length !== 0) {
            $.ajax("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=sendMessage&idUser=" + infos ['id'] +
                "&idConv=" + infos['idConv'] +
                "&msg=" + msg);
            input.val("");
        }
    }

    function refreshMessages() {
        if (infos ['idConv'] !== -1) {
            $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getMessages&id=" + infos ['idConv'],
                (messages) => {
                    if (nbMessages !== messages.length) {
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

    function loadBot(id) {
        if (id === -1)
            id = 0;
        infos['botQuestion'] = id;
        $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getBotQuestion&id=" + id, (question) => {
            box.empty();
            box.append("<div class='bot-msg'>" + question.txt + "</div>");

            box.append("<span id='bot-choose-ans'>Choisissez une réponse : </span>");

            for (let i = 0; i < question.ans.length; ++i) {
                let idNext = question.ans[i].nextQuestion;
                box.append("<div class='bot-rep' id='nQ" + i + "'>" + question.ans[i].txt + "</div>");
                $("#nQ" + i).click(function () {
                    loadBot(idNext)
                })
            }
        })
    }

    function backToList() {
        infos ['idConv'] = -1;
        openChat();
    }
});