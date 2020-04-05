$(document).ready(() => {
    let id = $(".form").first().attr("id").replace("id-", "");

    let pseudoEditing = false;
    let pseudoInput = $("#pseudo-input");
    $("#edit-pseudo").click(() => {
        if (pseudoEditing) {
            let val = pseudoInput.val();
            if (val.length === 0) {
                alert("Veuillez remplir ce champ.");
                return;
            }
            pseudoInput.attr({
                "disabled" : true
            });
            $.ajax(`/?controller=ajax&action=changePseudo&id=${id}&pseudo=${val}`)
                .then(refresh);
        } else {
            pseudoInput.attr({
                "disabled" : false
            });
            $("#edit-pseudo").html("Sauvegarder le pseudo");
        }
        pseudoEditing = !pseudoEditing;
    });

    let mailEditing = false;
    let mailInput = $("#mail");
    $("#edit-mail").click(() => {
        if (mailEditing) {
            let val = mailInput.val();
            if (val.length === 0) {
                alert("Veuillez remplir ce champ.");
                return;
            }
            mailInput.attr({
                "disabled" : true
            });
            $.ajax(`/?controller=ajax&action=changeMail&id=${id}&mail=${val}`)
                .then(refresh);
        } else {
            mailInput.attr({
                "disabled" : false
            });
            $("#edit-mail").html("Sauvegarder le mail");
        }
        mailEditing = !mailEditing;
    });

    let pwdEditing = false;
    let pwdInput = $("#password");
    $("#edit-pwd").click(() => {
        if (pwdEditing) {
            let val = pwdInput.val();
            if (val.length === 0) {
                alert("Veuillez remplir ce champ.");
                return;
            }
            pwdInput.attr({
                "disabled" : true
            });
            $.ajax(`/?controller=ajax&action=changePwd&id=${id}&pwd=${val}`)
                .then(refresh);
        } else {
            pwdInput.attr({
                "disabled" : false
            });
            $("#edit-pwd").html("Sauvegarder le mot de passe");
        }
        pwdEditing = !pwdEditing;
    });

    $("input[type='radio'][name='img']").change((event) => {
        let idRadio = event.target.id;
        let img = $(`#${idRadio}`).val();
        $.ajax(`/?controller=ajax&action=changeImg&id=${id}&img=${img}`)
            .then(refresh);
    });

    const refresh = () => {
        window.location.reload();
    };
});