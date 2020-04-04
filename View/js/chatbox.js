let status = {
	"idUser": getCookie("idUser"),
	"idConv": -1,
	"idUser2": -1,
	"botQuestion": -1
};

let nbMessages = -1;

const chat = $("#chatbox");
const box = $("#chatbox-box");
const header = $("#chatbox-header");
const footer = $("#chatbox-footer");

const closeBtn =
	`<img src='http://img.icons8.com/metro/26/000000/cancel.png' alt='réduire' class='chatbox-btn' id='reduce-chatbox'>`;
const returnBtn =
	`<img src="http://img.icons8.com/android/24/000000/circled-left-2.png" alt="retour" class="chatbox-btn" id="return">`;
const reportBtn =
	`<img src="https://img.icons8.com/material-outlined/24/000000/flag.png" alt='signaler' class='chatbox-btn' id='report_user'>`;

const footerHtml =
	`<input type='text' placeholder='Entrez votre message ici ...' id='input-msg'>
        <img id='chatbox-send' src='http://img.icons8.com/ios-glyphs/30/000000/paper-plane.png' alt='envoyer' class='chatbox-btn'>`;


$(document).ready(() => {
	chat.click(openChat);
});

function openChat() {
	chat.off("click");
	chat.removeClass("closed");
	
	if (status.idConv === -1) {
		header.empty();
		header.append(`<h1>Preclarity Chat</h1>`)
		header.append(closeBtn);
		footer.empty();
		showConvs();
	} else {
		openConv(status.idConv);
	}
	
	chat.addClass("opened");
	$("#reduce-chatbox").click(closeChat);
}

function closeChat() {
	header.html(`<h1>Preclarity Chat</h1>`);
	
	chat.addClass("closed");
	chat.removeClass("opened");
	
	box.empty();
	footer.empty();
	
	setTimeout(() => {
		chat.click(openChat);
	}, 1);
}

function showConvs() {
	$.getJSON(
		`http://preclarity.ulyssebouchet.fr/?controller=ajax&action=getConversations&id=${status.idUser}`,
		async function(convs) {
			
			let content = "<ul id='chatbox-convs'>";
			content +=
				`<li id='chatbox-bot'>
                    <img class='pp' src='https://cdn.dribbble.com/users/37530/screenshots/2937858/drib_blink_bot.gif' alt='bot'>
                    Preclaribot
                </li>`;
			
			let ids = [];
			for (let i = 0; i < convs.length; ++i) {
				let isUser1 = convs[i].idUser1 === status.idUser;
				if ((isUser1 && convs[i].visible1 === "1") || (!isUser1 && convs[i].visible2 === "1")) {
					let idPerson = convs[i].idUser1 === status.idUser ? convs[i].idUser2 : convs[i].idUser1;
					let idConv = convs[i].id;
					ids.push(idConv);
					
					await $.getJSON(
						`http://preclarity.ulyssebouchet.fr/?controller=ajax&action=getUser&id=${idPerson}`,
						(person) => {
							content +=
								`<li id='p${idConv}'>
                            <img class='pp' src='${person.imageProfil}' alt='profile picture'>
                            ${person.pseudo}
                            <span class="supp" id="supp${idConv}">
                            	<img class="chatbox-btn" src="https://img.icons8.com/material-outlined/24/000000/close-window.png" alt="delete"/>
														</span>
                        </li>`;
						});
				}
			}
			
			content += "</ul>";
			
			box.html(content);
			
			for (let i = 0; i < ids.length; ++i)
				$(`#p${ids[i]}`).click(() => {
					openConv(ids[i]);
				});
			
			for (let i = 0; i < ids.length; ++i)
				$(`#supp${ids[i]}`).click((event) => {
					event.stopPropagation();
					if (confirm ("Voulez-vous vraiment supprimer cette conversation ? \n" +
						"Vous ne pourrez plus jamais la revoir, ni recontacter cet utilisateur.")) {
						let numUser = status.idUser === convs[i].idUser1 ? 1 : 2;
						$.ajax(`/?controller=ajax&action=deleteConv&idConv=${ids[i]}&numUser=${numUser}`)
							.then(() => {
								alert("La conversation a été supprimée.");
								location.reload();
							});
					}
				});
			
			$("#chatbox-bot").click(() => {
				openConv(-10);
			})
		});
}

function sendMessage() {
	let input = $("#input-msg");
	let msg = input.val();
	msg = encodeURIComponent(msg);
	if (msg.length !== 0) {
		$.ajax(
			`http://preclarity.ulyssebouchet.fr/?controller=ajax&action=sendMessage&idUser=${status.idUser}&idConv=${status.idConv}&msg=${msg}`
		);
		input.val("");
	}
}

function refreshMessages() {
	if (status.idConv !== -1) {
		$.getJSON(
			`http://preclarity.ulyssebouchet.fr/?controller=ajax&action=getMessages&id=${status.idConv}`,
			(messages) => {
				if (nbMessages !== messages.length) {
					nbMessages = messages.length;
					box.empty();
					for (let i = 0; i < messages.length; ++i) {
						let msg = messages[i].content;
						msg = decodeURIComponent(msg);
						if (messages[i].idAuteur !== status.idUser)
							box.append(
								`<div class='chat-msg'>${msg}</div>`);
						else
							box.append(
								`<div class='chat-msg user'>${msg}</div>`);
						
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
	
	status.botQuestion = id;
	$.getJSON(
		`http://preclarity.ulyssebouchet.fr/?controller=ajax&action=getBotQuestion&id=${id}`,
		(question) => {
			box.empty();
			
			box.append(
				`<div class='bot-msg'>${question.txt}</div>
                    <span id='bot-choose-ans'>Choisissez une réponse : </span>`
			);
			
			for (let i = 0; i < question.ans.length; ++i) {
				let idNext = question.ans[i].nextQuestion;
				box.append(
					`<div class='bot-rep' id='nQ${i}'>${question.ans[i].txt}</div>`
				);
				$(`#nQ${i}`).click(function() {
					loadBot(idNext)
				})
			}
		})
}

function backToList() {
	status.idConv = -1;
	openChat();
}

function openConv(id) {
	status.idConv = id;
	
	if (id === -10) {
		header.empty();
		header.append(returnBtn);
		header.append(`<h1>PreclariBot</h1>`);
		header.append(closeBtn);
		
		$("#reduce-chatbox").click(closeChat);
		$("#return").click(backToList);
		
		loadBot(status.botQuestion);
	} else {
		$.getJSON(
			`http://preclarity.ulyssebouchet.fr/?controller=ajax&action=getConversation&id=${id}`,
			(conv) => {
				let idPerson = conv.idUser1 === status.idUser ? conv.idUser2 : conv.idUser1;
				status.idUser2 = idPerson;
				$.getJSON(
					`http://preclarity.ulyssebouchet.fr/?controller=ajax&action=getUser&id=${idPerson}`,
					(person) => {
						
						header.empty();
						header.append(returnBtn);
						header.append(
							`<h1>${person.pseudo} ${reportBtn}</h1>`
						);
						header.append(closeBtn);
						
						$("#reduce-chatbox").click(closeChat);
						$("#return").click(backToList);
						
						$("#report_user").click(() => {
							if (confirm(
								"Voulez-vous vraiment signaler cet utilisateur ?"
							)) {
								let c = "user";
								let a = "report";
								let i = status.idUser2;
								let p = "Conversation";
								document.location =
									`http://preclarity.ulyssebouchet.fr/?controller=${c}&action=${a}&idSignale=${i}&origine=${p}`;
								
							}
						});
						nbMessages = -1;
						refreshMessages();
					});
			});
		
		footer.html(footerHtml);
		
		$('#input-msg').on('keypress', (e) => {
			if (e.which === 13) {
				sendMessage();
			}
		});
		
		$("#chatbox-send").click(sendMessage);
	}
}

function getCookie(name) {
	let value = "; " + document.cookie;
	let parts = value.split("; " + name + "=");
	if (parts.length === 2) return parts.pop().split(";").shift();
}