$(document).ready(() => {
    const inputMotif = $("#motif");
    $("#report").submit((event) => {
        if (inputMotif.val().length === 0) {
            event.preventDefault();
            alert("Veuillez remplir le champ 'Motif'");
        }
    });
});