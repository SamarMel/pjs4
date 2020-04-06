$(document).ready(() => {
    let editing = [];
    $(".edit").click((event) => {
        let id = event.target.id;
        let modify = $(`#modify-${id}`);
        if (editing[id] === undefined)
            editing[id] = false;
        
        if (editing[id]) {
            modify.attr (
              {
                  "disabled" : true
              }
            );
            let txt = modify.val();
            $.ajax(`/?controller=ajax&action=updatePost&id=${id}&txt=${txt}`);
            $(`#${id}`).html("Modifier");
        } else {
            modify.attr (
              {
                  "disabled" : false
              }
            );
            $(`#${id}`).html("Sauvegarder");
            modify.focus();
        }
        editing[id] = !editing[id];
    });
    
    $("#send-response").submit((event) => {
        if (!validation()) {
            event.preventDefault();
            alert("Le message ne peut pas être vide.");
        }
    });

    $(".contact-person").click((event) => {
        event.preventDefault();
        let callerId = event.target.id.substring(1);
        if (confirm("Voulez-vous contacter cet utilisateur ?")) {
            $.getJSON(`/?controller=ajax&action=newConv&idPerson=${callerId}`,
                (response) => {
                    openChat();
                    setTimeout(() => {
                        openConv(response);
                    }, 500);
                });
        }
    })

    function validation(){
        let post = document.forms["msg"]["post"].value.trim();
        return !!post;
    }
});