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

    /*function closeChat() {
        const chat = document.getElementById("chatbox");
        const header = document.getElementById("chatbox-header");
        let height = 50;
        document.getElementById("reduce-chatbox").removeEventListener("click", closeChat);
        chat.classList.add("closed");

        header.innerHTML = "<h1>Preclarity Chat</h1>";
        let timer = setInterval(() => {
            height -= 0.25;
            chat.style.height = height + "vh";
            if(height === 6) {
                clearInterval(timer);
                chat.addEventListener("click", openChat);
            }
        }, 4);
    }*/

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
            "<img src=\"https://img.icons8.com/ios-glyphs/30/000000/paper-plane.png\" alt=\"envoyer\" class=\"chatbox-btn\">");

        box.empty();

        $.getJSON("http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getMessages&id=" + id, (messages) => {
            for (let i = 0; i < messages.length; ++i) {
                if (messages[i]['idAuteur'] !== id.toString())
                    box.append ("<div class='chat-msg'>" + messages[i]['content'] + "</div>");
                else
                    box.append ("<div class='chat-msg user'>" + messages[i]['content'] + "</div>");
            }
        });
/*
        const req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if(req.status === 200 && req.readyState === 4) {
                let messages = JSON.parse(req.responseText);
                for (let i = 0; i < messages.length; ++i) {
                    if (messages[i]['idAuteur'] !== id.toString())
                        box.append ("<div class='chat-msg'>" + messages[i]['content'] + "</div>");
                    else
                        box.append ("<div class='chat-msg user'>" + messages[i]['content'] + "</div>");
                }
            }
        };
        req.open("GET", "http://pjs4.ulyssebouchet.fr/Controller/ajax.php?query=getMessages&id=" + idConv);
        req.send('');*/
    }
/*
    function showConvs() {
        const box = document.getElementById("chatbox-box");
        box.innerHTML = "";

        let convs;

        const request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if(request.status === 200 && request.readyState === 4) {
                convs = JSON.parse(request.responseText);

                let content = "";
                content += "<ul id='chatbox-convs'>";

                for (let i = 0; i < convs.length; ++i) {
                    const req = new XMLHttpRequest();
                    req.onreadystatechange = () => {
                        if(req.status === 200 && req.readyState === 4) {
                            let person = JSON.parse(req.responseText);
                            content += "<li onclick=\"openConv(this.value,'" + person['pseudo'] + "')\" value=" + convs[i]["id"] + ">"
                                + "<img class='pp' src='" + person['imageProfil'] + "' alt='profile picture'>"
                                + person['pseudo'] + "</li>";
                            box.innerHTML =  content + "</ul>";
                        }
                    };
                    let idUser = convs[i]['idUser1'] === id.toString() ? convs[i]['idUser2'] : convs[i]['idUser1'];
                    req.open("GET", "http://pjs4.ulyssebouchet.fr/Contoller/ajax.php?query=getUser&id=" + idUser);
                    req.send('');
                }
            }
        };

        request.open("GET", "http://pjs4.ulyssebouchet.fr/AJAX/getConversations.php?id=" + id);
        request.send("");
    }*/

    function backToList() {
        idConv = -1;
        openChat();
    }
});