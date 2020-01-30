document.getElementById("chatbox").addEventListener("click", openChat);
document.getElementById("chatbox").addEventListener("mouseenter", show);

function openChat() {
    const chat = document.getElementById("chatbox");
    let height = 8;
    chat.removeEventListener("click", openChat);

    chat.removeEventListener("mouseenter", show);
    chat.removeEventListener("mouseleave", hide);

    document.getElementById("chatbox-header").innerHTML =
        "<img src=\"https://img.icons8.com/android/24/000000/circled-left-2.png\" alt=\"retour\" class=\"chatbox-btn\" id=\"back-to-list\">\n" +
        "<h1>Albéric</h1>\n" +
        "<img src=\"https://img.icons8.com/metro/26/000000/cancel.png\" alt=\"réduire\" class=\"chatbox-btn\" id=\"reduce-chatbox\">";
    document.getElementById("back-to-list").addEventListener("click", back);
    let timer = setInterval(() => {
        console.log(height);
        height += 0.25;
        chat.style.height = height + "vh";
        if(height === 50) {
            clearInterval(timer);
            document.getElementById("reduce-chatbox").addEventListener("click", closeChat);
        }
    }, 4);
}

function closeChat() {
    const chat = document.getElementById("chatbox");
    let height = 50;
    document.getElementById("reduce-chatbox").removeEventListener("click", closeChat);

    chat.removeEventListener("mouseenter", show);
    chat.removeEventListener("mouseleave", hide);

    document.getElementById("chatbox-header").innerHTML = "<h1>Preclarity Chat v0.1</h1>";
    let timer = setInterval(() => {
        console.log(height);
        height -= 0.25;
        chat.style.height = height + "vh";
        if(height === 6) {
            clearInterval(timer);
            chat.addEventListener("click", openChat);
            chat.addEventListener("mouseenter", show);
        }
    }, 4);
}

function show() {
    const chat = document.getElementById("chatbox");
    let height = 6;
    chat.removeEventListener("mouseenter", show);
    let timer = setInterval(() => {
        console.log(height);
        height += 0.125;
        chat.style.height = height + "vh";
        if(height === 8) {
            clearInterval(timer);
            chat.addEventListener("mouseleave", hide);
        }
    }, 1);
}

function hide(){
    const chat = document.getElementById("chatbox");
    chat.removeEventListener("mouseleave", hide);
    let height = 8;
    let timer = setInterval(() => {
        console.log(height);
        height -= 0.125;
        chat.style.height = height + "vh";
        if(height === 6) {
            clearInterval(timer);
            chat.addEventListener("mouseenter", show);
        }
    }, 1);
}

function back() {

}