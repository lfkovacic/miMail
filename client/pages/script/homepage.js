import { RELATIVE_URL } from "../../consts/consts.js";
import { mailService } from "../../api/mailService.js";
import { Cookie } from "../../util/cookies.js";

const sendMailButton = document.getElementById("send-mail-button");
const fSendMail = () => {
    const mailObj = {};
    const recipient = document.getElementById('input-recipient').value;
    const subject = document.getElementById('input-subject').value;
    const content = document.getElementById('input-content').value;

    mailObj.sender = Cookie.get("username") + '@mimail.org';
    mailObj.recipient = recipient;
    mailObj.subject = subject;
    mailObj.body = content;

    if (!(recipient === "" || subject === "" || content === "")) {
        mailService.sendMail(mailObj)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
    }
}
sendMailButton.addEventListener("click", fSendMail);
let isMailFetched = false;
const fGetAllMail = () => {

    if (!isMailFetched) {
        const inbox = document.getElementById('option_inbox');
        console.log(inbox);
        const arr = [];
        mailService.getAllMail().then((response) => {
            console.log(response);
            for (const mail of response) {
                const mailDiv = document.createElement('div');
                mailDiv.id = mail.id;
                mailDiv.innerHTML = mail.content;
                mailDiv.addEventListener('click', (mail) => fGetMail(mail.id))
                inbox.appendChild(mailDiv);
            }
        })
        isMailFetched = true;
    }
}
const fGetMail = (id) => {
    mailService.getMail(id).then((response) => {
        console.log(response);
        const inputContainer = document.getElementById('input-container');
        inputContainer.className = 'hidden';
        const mailContainer = document.getElementById('mail-container');
        mailContainer.innerHTML = '';
        mailContainer.className = "mail-container";
        const fromDiv = document.createElement('div');
        const subjectDiv = document.createElement('div');
        const contentDiv = document.createElement('div');
        fromDiv.id = 'from-div';
        subjectDiv.id = 'subject-div';
        contentDiv.id = 'content-div';
        fromDiv.innerHTML = response.sender;
        subjectDiv.innerHTML = response.subject;
        contentDiv.innerHTML = response.content;
        mailContainer.appendChild(fromDiv);
        mailContainer.appendChild(subjectDiv);
        mailContainer.appendChild(contentDiv);
    })
}
const inbox = document.getElementById('option_inbox');
inbox.addEventListener('click', fGetAllMail);

const fShowComposeMail = () => {
    const inputContainer = document.getElementById ('input-container');
    inputContainer.className = "input-container";
    const mailContainer = document.getElementById ('mail-container');
    mailContainer.className = 'hidden';
}

const composeMail = document.getElementById('compose-mail');
composeMail.addEventListener('click', fShowComposeMail);