$(document).ready(() => {
    let idConv = -1;
    let curPseudo;
    let id = 1;

    const chat = $("#chatbox");

    chat.click(openChat);

    function openChat() {
        chat.off("click");
        chat.removeClass("closed");

        if(idConv === -1) {
            $("#chatbox-header").html("<h1>Preclarity Chat</h1>" +
                "<img src='https://img.icons8.com/metro/26/000000/cancel.png' alt='réduire' class='chatbox-btn' id='reduce-chatbox'>");
            $("#chatbox-footer").empty();
            showConvs();
        } else {
            openConv(idConv, curPseudo);
        }

        chat.animate({height: "50vh"}, "slow");
        $("#reduce-chatbox").click(closeChat);
    }

    function closeChat() {
        $("#chatbox-header").html("<h1>Preclarity Chat</h1>");
        chat.height("5vh");
        chat.addClass("closed");

        setTimeout(() => {
            chat.click(openChat);
        }, 1);
    }

    function showConvs() {
        const box = $("#chatbox-box");
        box.empty();

        $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getConversations&id=" + id, async function (convs) {
            let content = "<ul id='chatbox-convs'>";
            let ids = [];
            let pseudos = [];
            for (let i = 0; i < convs.length; ++i) {
                let idUser = convs[i]['idUser1'] === id.toString() ? convs[i]['idUser2'] : convs[i]['idUser1'];

                await $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getUser&id=" + idUser, (person) => {
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

    function openConv(id, pseudo) {
        const header = $("#chatbox-header");
        const box = $("#chatbox-box");
        const footer = $("#chatbox-footer");

        idConv = id;
        curPseudo = pseudo;

        header.html(
            '<img src="https://img.icons8.com/android/24/000000/circled-left-2.png" alt="retour" class="chatbox-btn" id="back-to-list">'
            + "<h1>"  + pseudo + "</h1>" +
            '<img src="https://img.icons8.com/metro/26/000000/cancel.png" alt="réduire" class="chatbox-btn" id="reduce-chatbox">');

        $("#reduce-chatbox").click(closeChat);
        $("#back-to-list").click(backToList);

        footer.html(
            "<input type=\"text\" placeholder=\"Entrez votre message ici ...\">" +
            "<img id='chatbox-send' src=\"https://img.icons8.com/ios-glyphs/30/000000/paper-plane.png\" alt=\"envoyer\" class=\"chatbox-btn\">");

        box.empty();

        $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getMessages&id=" + id, (messages) => {
            for (let i = 0; i < messages.length; ++i) {
                if (messages[i]['idAuteur'] !== id.toString())
                    box.append ("<div class='chat-msg'>" + messages[i]['content'] + "</div>");
                else
                    box.append ("<div class='chat-msg user'>" + messages[i]['content'] + "</div>");
            }
        });
    }

    function backToList() {
        idConv = -1;
        openChat();
    }
});