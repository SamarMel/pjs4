$(document).ready(() => {
    $("#QuestLog").change((event) => {
        let value = event.target.value; // Contient la nouvelle valeur de la liste déroulante sélectionnée par le client
        if (value === "Coloc") {
            alert("Rendez-vous dans la rubrique \"Logement\"");
        } else if (value === "Aides"){
            alert("Rendez-vous dans la rubrique \"Aides\"");
        }
    });

    $("#QuestSante").change((event) => {
        let value = event.target.value; // Contient la nouvelle valeur de la liste déroulante sélectionnée par le client
        if (value === "Medecins") {
            alert("Rendez-vous dans la rubrique \"Santé\"");
        } else if (value === "Consult"){
            alert("Rendez-vous dans la rubrique \"Santé\"");
        }
    });

    $("#QuestEtudes").change((event) => {
        let value = event.target.value; // Contient la nouvelle valeur de la liste déroulante sélectionnée par le client
        if (value === "Orientation") {
            alert("Rendez-vous dans la rubrique \"Études\"");
        } else if (value === "Cours"){
            alert("Rendez-vous dans la rubrique \"Études\"");
        }
    });

    $("#QuestAides").change((event) => {
        let value = event.target.value; // Contient la nouvelle valeur de la liste déroulante sélectionnée par le client
        if (value === "Allocs") {
            alert("Rendez-vous dans la rubrique \"Aides\"");
        } else if (value === "Prêts"){
            alert("Rendez-vous dans la rubrique \"Aides\"");
        }
    });

    $("#Choix1").click(() => {
        $("#rep1").css({
            display : "flex"
        });
        $("#rep2").css({
            display : "none"
        });
    });

    $("#Choix2").click(() => {
        $("#rep1").css({
            display : "none"
        });
        $("#rep2").css({
            display : "flex"
        });
    });

    $("#Choix3").click(() => {
        $("#rep3").css({
            display : "flex"
        });
        $("#rep4").css({
            display : "none"
        });
    });

    $("#Choix4").click(() => {
        $("#rep3").css({
            display : "none"
        });
        $("#rep4").css({
            display : "flex"
        });
    });

    $("#Choix5").click(() => {
        $("#rep5").css({
            display : "flex"
        });
        $("#rep6").css({
            display : "none"
        });
    });

    $("#Choix6").click(() => {
        $("#rep5").css({
            display : "none"
        });
        $("#rep6").css({
            display : "flex"
        });
    });
    $("#Choix7").click(() => {
        $("#rep7").css({
            display : "flex"
        });
        $("#rep8").css({
            display : "none"
        });
    });
    $("#Choix8").click(() => {
        $("#rep7").css({
            display : "none"
        });
        $("#rep8").css({
            display : "flex"
        });
    });
});