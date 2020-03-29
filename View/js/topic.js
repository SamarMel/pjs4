$(document).ready(() => {
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
            $.getJSON(`http://pjs4.ulyssebouchet.fr/?controller=ajax&action=newConv&idPerson=${callerId}`,
                (response) => {
                    openChat();
                    openConv(response.id);
                });
        }
    })

    function validation(){
        let post = document.forms["msg"]["post"].value.trim();
        return !!post;
    }
});