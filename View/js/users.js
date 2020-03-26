$(document).ready(() => {
    $("select.role").on("input", (e) => {
        let id = e.target.parentElement.id.replace("person-", "");
        let role = e.target.value;
        $.ajax(`http://pjs4.ulyssebouchet.fr/?controller=ajax&action=changeRole&idUser=${id}&idRole=${role}`)
    });

    function getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }
});